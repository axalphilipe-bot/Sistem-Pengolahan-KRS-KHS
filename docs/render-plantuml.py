#!/usr/bin/env python3
"""Render PlantUML file to PNG and SVG."""
import sys
import zlib
import urllib.error
import urllib.request
from pathlib import Path


def encode6bit(b: int) -> str:
    if b < 10:
        return chr(48 + b)
    b -= 10
    if b < 26:
        return chr(65 + b)
    b -= 26
    if b < 26:
        return chr(97 + b)
    b -= 26
    if b == 0:
        return "-"
    if b == 1:
        return "_"
    return "?"


def append3bytes(b1: int, b2: int, b3: int) -> str:
    c1 = b1 >> 2
    c2 = ((b1 & 0x3) << 4) | (b2 >> 4)
    c3 = ((b2 & 0xF) << 2) | (b3 >> 6)
    c4 = b3 & 0x3F
    return encode6bit(c1) + encode6bit(c2) + encode6bit(c3) + encode6bit(c4)


def plantuml_encode(text: str) -> str:
    compressed = zlib.compress(text.encode("utf-8"))[2:-4]
    result = []
    for i in range(0, len(compressed), 3):
        if i + 2 == len(compressed):
            result.append(append3bytes(compressed[i], compressed[i + 1], 0))
        elif i + 1 == len(compressed):
            result.append(append3bytes(compressed[i], 0, 0))
        else:
            result.append(
                append3bytes(compressed[i], compressed[i + 1], compressed[i + 2])
            )
    return "".join(result)


def is_valid(data: bytes, fmt: str) -> bool:
    if fmt == "png":
        return data[:8] == b"\x89PNG\r\n\x1a\n"
    if fmt == "svg":
        return b"<svg" in data[:500].lower()
    return False


def fetch(url: str, data: bytes | None = None, method: str = "GET") -> bytes:
    headers = {"User-Agent": "Mozilla/5.0"}
    if data is not None:
        headers["Content-Type"] = "text/plain; charset=utf-8"
    req = urllib.request.Request(url, data=data, headers=headers, method=method)
    with urllib.request.urlopen(req, timeout=120) as resp:
        return resp.read()


def render(puml_path: Path, fmt: str, out_path: Path) -> None:
    text = puml_path.read_text(encoding="utf-8")
    encoded = plantuml_encode(text)
    errors = []

    candidates = [
        ("GET", f"https://cdn-0.plantuml.com/plantuml/{fmt}/{encoded}", None),
        ("GET", f"https://www.plantuml.com/plantuml/{fmt}/{encoded}", None),
        ("POST", f"https://kroki.io/plantuml/{fmt}", text.encode("utf-8")),
    ]

    data = None
    for method, url, body in candidates:
        try:
            payload = fetch(url, body, method)
            if is_valid(payload, fmt):
                data = payload
                break
            errors.append(f"{method} {url[:60]}... invalid {fmt}")
        except Exception as exc:
            errors.append(f"{method} {url[:60]}... {exc}")

    if data is None:
        raise RuntimeError(
            f"PlantUML render failed for {puml_path.name}: " + " | ".join(errors)
        )

    out_path.write_bytes(data)
    print(f"OK: {out_path} ({len(data):,} bytes)")


def main() -> int:
    base = Path(__file__).resolve().parent
    files = [
        ("use-case-diagram-image.puml", "use-case-diagram.png", "use-case-diagram.svg"),
        ("use-case-diagram.puml", "use-case-diagram-full.png", "use-case-diagram-full.svg"),
    ]
    for puml_name, png_name, svg_name in files:
        puml = base / puml_name
        if not puml.exists():
            print(f"SKIP: {puml_name} not found")
            continue
        try:
            render(puml, "png", base / png_name)
            render(puml, "svg", base / svg_name)
        except Exception as exc:
            print(f"FAIL {puml_name}: {exc}", file=sys.stderr)
            return 1
    return 0


if __name__ == "__main__":
    raise SystemExit(main())
