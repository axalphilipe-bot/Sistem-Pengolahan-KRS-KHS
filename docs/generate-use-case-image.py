#!/usr/bin/env python3
"""Generate Use Case Diagram PNG matching reference column-color layout."""
from __future__ import annotations

from pathlib import Path
from PIL import Image, ImageDraw, ImageFont

ROOT = Path(__file__).resolve().parent
OUT = ROOT / "use-case-diagram.png"

W, H = 2200, 1500
BG = (58, 58, 58)
WHITE = (255, 255, 255)
LINE = (210, 210, 210)

COLORS = {
    "shared": (124, 58, 237),
    "mhs": (37, 99, 235),
    "dsn": (22, 163, 74),
    "adm": (217, 119, 6),
    "kps": (219, 39, 119),
}

ACTORS = {
    "mhs": (120, 180),
    "dsn": (120, 1180),
    "adm": (2060, 180),
    "kps": (2060, 1180),
}

COLUMNS = {
    "shared": (560, 120),
    "mhs": (560, 280),
    "dsn": (560, 900),
    "adm": (1320, 120),
    "kps": (1320, 900),
}

USECASES = {
    "shared": ["Login", "Lihat Semester Aktif"],
    "mhs": [
        "Lihat Daftar Mata Kuliah",
        "Mengisi / Submit KRS",
        "Lihat Status KRS",
        "Lihat KHS / Nilai",
        "Cetak KHS (PDF)",
    ],
    "dsn": [
        "Input Nilai Mahasiswa",
        "Edit Nilai",
        "Lihat KRS Mahasiswa Wali",
        "Setujui / Tolak KRS",
        "Import Nilai Excel",
    ],
    "adm": [
        "Kelola Data Mahasiswa",
        "Kelola Data Dosen",
        "Kelola Mata Kuliah",
        "Pengaturan Sistem",
        "Lihat Pengajuan KRS",
        "Validasi Nilai Admin",
        "Laporan KRS & KHS",
        "Manajemen Akun User",
    ],
    "kps": [
        "Validasi Nilai",
        "Setujui / Tolak Nilai",
        "Kunci Nilai Global",
        "Kunci / Buka Nilai",
        "Laporan Nilai",
    ],
}

LINKS = {
    "mhs": ["shared", "mhs"],
    "dsn": ["shared", "dsn"],
    "adm": ["shared", "adm"],
    "kps": ["shared", "kps"],
}


def load_font(size: int, bold: bool = False) -> ImageFont.FreeTypeFont | ImageFont.ImageFont:
    candidates = [
        "C:/Windows/Fonts/arialbd.ttf" if bold else "C:/Windows/Fonts/arial.ttf",
        "C:/Windows/Fonts/segoeui.ttf",
        "/usr/share/fonts/truetype/dejavu/DejaVuSans.ttf",
    ]
    for path in candidates:
        if Path(path).exists():
            return ImageFont.truetype(path, size)
    return ImageFont.load_default()


def wrap(text: str, font: ImageFont.ImageFont, max_w: int) -> list[str]:
    words = text.split()
    lines: list[str] = []
    current = ""
    for word in words:
        trial = f"{current} {word}".strip()
        if font.getlength(trial) <= max_w:
            current = trial
        else:
            if current:
                lines.append(current)
            current = word
    if current:
        lines.append(current)
    return lines or [text]


def ellipse_box(text: str, font: ImageFont.ImageFont, pad_x=26, pad_y=14) -> tuple[int, int]:
    lines = wrap(text, font, 220)
    line_h = font.size + 6
    text_w = max(font.getlength(line) for line in lines)
    text_h = line_h * len(lines)
    return int(text_w + pad_x * 2), int(text_h + pad_y * 2)


def draw_actor(draw: ImageDraw.ImageDraw, x: int, y: int, label: str, font, small) -> tuple[int, int]:
    # stick figure
    cx, head_y = x, y
    draw.ellipse((cx - 18, head_y - 18, cx + 18, head_y + 18), outline=WHITE, width=3)
    draw.line((cx, head_y + 18, cx, head_y + 70), fill=WHITE, width=3)
    draw.line((cx - 28, head_y + 38, cx + 28, head_y + 38), fill=WHITE, width=3)
    draw.line((cx, head_y + 70, cx - 22, head_y + 110), fill=WHITE, width=3)
    draw.line((cx, head_y + 70, cx + 22, head_y + 110), fill=WHITE, width=3)
    tw = small.getlength(label)
    draw.text((cx - tw / 2, head_y + 120), label, fill=WHITE, font=small)
    return cx, head_y + 55


def draw_usecase(
    draw: ImageDraw.ImageDraw,
    cx: int,
    cy: int,
    text: str,
    color: tuple[int, int, int],
    font: ImageFont.ImageFont,
) -> tuple[int, int, int, int]:
    w, h = ellipse_box(text, font)
    x0, y0, x1, y1 = cx - w // 2, cy - h // 2, cx + w // 2, cy + h // 2
    draw.ellipse((x0, y0, x1, y1), fill=color, outline=WHITE, width=2)
    lines = wrap(text, font, 220)
    line_h = font.size + 6
    total_h = line_h * len(lines)
    ty = cy - total_h // 2 + 2
    for line in lines:
        tw = font.getlength(line)
        draw.text((cx - tw / 2, ty), line, fill=WHITE, font=font)
        ty += line_h
    return x0, y0, x1, y1


def main() -> None:
    img = Image.new("RGB", (W, H), BG)
    draw = ImageDraw.Draw(img)

    title_font = load_font(28, bold=True)
    uc_font = load_font(16)
    actor_font = load_font(18, bold=True)
    sub_font = load_font(14)

    title = "Use Case Diagram — Sistem Pengelolaan KRS & KHS"
    tw = title_font.getlength(title)
    draw.text(((W - tw) / 2, 30), title, fill=WHITE, font=title_font)

    # subtle grid
    for x in range(0, W, 40):
        draw.line((x, 0, x, H), fill=(68, 68, 68), width=1)
    for y in range(0, H, 40):
        draw.line((0, y, W, y), fill=(68, 68, 68), width=1)

    actor_points: dict[str, tuple[int, int]] = {}
    actor_points["mhs"] = draw_actor(draw, ACTORS["mhs"][0], ACTORS["mhs"][1], "Mahasiswa", actor_font, sub_font)
    actor_points["dsn"] = draw_actor(draw, ACTORS["dsn"][0], ACTORS["dsn"][1], "Dosen", actor_font, sub_font)
    actor_points["adm"] = draw_actor(draw, ACTORS["adm"][0], ACTORS["adm"][1], "Admin", actor_font, sub_font)
    actor_points["kps"] = draw_actor(draw, ACTORS["kps"][0], ACTORS["kps"][1], "KPS", actor_font, sub_font)

    boxes: dict[str, list[tuple[int, int, int, int, str]]] = {k: [] for k in USECASES}
    y_gap = 18

    for group, items in USECASES.items():
        cx, start_y = COLUMNS[group]
        cy = start_y
        color = COLORS.get(group, COLORS["shared"])
        for label in items:
            _, h = ellipse_box(label, uc_font)
            box = draw_usecase(draw, cx, cy + h // 2, label, color, uc_font)
            boxes[group].append((*box, label))
            cy += h + y_gap

    def nearest_edge(box, side: str) -> tuple[int, int]:
        x0, y0, x1, y1, _ = box
        if side == "left":
            return x0, (y0 + y1) // 2
        if side == "right":
            return x1, (y0 + y1) // 2
        return (x0 + x1) // 2, y0

    for actor, groups in LINKS.items():
        ax, ay = actor_points[actor]
        side = "left" if actor in ("adm", "kps") else "right"
        for group in groups:
            for box in boxes[group]:
                bx, by = nearest_edge(box, "left" if side == "right" else "right")
                sx = ax + (24 if side == "right" else -24)
                draw.line((sx, ay, bx, by), fill=LINE, width=2)

    # legend
    lx, ly = 80, H - 120
    draw.text((lx, ly), "Legenda:", fill=WHITE, font=sub_font)
    legend = [
        ("shared", "Bersama"),
        ("mhs", "Mahasiswa"),
        ("dsn", "Dosen"),
        ("adm", "Admin"),
        ("kps", "KPS"),
    ]
    ox = lx + 90
    for key, name in legend:
        draw.ellipse((ox, ly + 2, ox + 18, ly + 20), fill=COLORS[key], outline=WHITE)
        draw.text((ox + 26, ly), name, fill=WHITE, font=sub_font)
        ox += 170

    img.save(OUT, format="PNG", optimize=True)
    print(f"OK: {OUT} ({OUT.stat().st_size:,} bytes)")


if __name__ == "__main__":
    main()
