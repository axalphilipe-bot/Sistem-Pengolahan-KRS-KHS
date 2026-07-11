#!/usr/bin/env python3
"""Generate Activity Diagram PNG files (swimlane style like reference)."""
from __future__ import annotations

from dataclasses import dataclass, field
from pathlib import Path
from typing import Literal

from PIL import Image, ImageDraw, ImageFont

OUT_DIR = Path(__file__).resolve().parent / "activity-diagrams"
OUT_DIR.mkdir(exist_ok=True)

W = 900
LANE_W = W // 2
BG = (245, 245, 245)
GRID = (220, 220, 220)
LANE_BG = (255, 255, 255)
LANE_LINE = (180, 180, 180)
ACTION = (255, 224, 102)
BORDER = (51, 51, 51)
START = (220, 38, 38)
ARROW = (51, 51, 51)
LABEL_YA = (34, 139, 34)
LABEL_TIDAK = (220, 38, 38)


@dataclass
class Step:
    kind: Literal["start", "stop", "action", "decision"]
    lane: int
    text: str
    branch: str | None = None


@dataclass
class Diagram:
    filename: str
    title: str
    lane_left: str
    lane_right: str
    steps: list[Step] = field(default_factory=list)


def font(size: int, bold: bool = False):
    paths = [
        "C:/Windows/Fonts/arialbd.ttf" if bold else "C:/Windows/Fonts/arial.ttf",
        "C:/Windows/Fonts/segoeui.ttf",
    ]
    for p in paths:
        if Path(p).exists():
            return ImageFont.truetype(p, size)
    return ImageFont.load_default()


def wrap_text(text: str, fnt, max_w: int) -> list[str]:
    lines: list[str] = []
    for part in text.split("\n"):
        words = part.split()
        cur = ""
        for w in words:
            trial = f"{cur} {w}".strip()
            if fnt.getlength(trial) <= max_w:
                cur = trial
            else:
                if cur:
                    lines.append(cur)
                cur = w
        if cur:
            lines.append(cur)
    return lines or [text]


def box_size(text: str, fnt, max_w: int = 300) -> tuple[int, int]:
    lines = wrap_text(text, fnt, max_w)
    lh = fnt.size + 4
    h = lh * len(lines) + 20
    w = min(max_w, max(int(max(fnt.getlength(l) for l in lines)) + 24, 160))
    return w, h


def lane_center(lane: int, box_w: int) -> int:
    return lane * LANE_W + (LANE_W - box_w) // 2


DIAGRAMS: list[Diagram] = [
    Diagram("01-login.png", "Diagram LOGIN", "Pengguna", "Sistem", [
        Step("start", 1, ""),
        Step("action", 1, "Tampilan Halaman Login"),
        Step("action", 0, "Pilih Role\nInput Login & Password\nKlik Login"),
        Step("action", 1, "Validasi form\nCari user & cek password"),
        Step("decision", 1, "Akun valid?"),
        Step("action", 1, "Auth::login\nRedirect Dashboard\n(sesuai role)", "Ya"),
        Step("stop", 1, "", "Ya"),
        Step("action", 0, "Tampilkan pesan Login gagal", "Tidak"),
        Step("stop", 0, "", "Tidak"),
    ]),
    Diagram("02-pengambilan-krs.png", "Diagram Pengisian KRS", "Mahasiswa", "Sistem", [
        Step("start", 0, ""),
        Step("action", 0, "Buka menu KRS"),
        Step("action", 0, "Pilih semester & prodi"),
        Step("action", 1, "Tampilkan daftar mata kuliah"),
        Step("action", 0, "Pilih MK & Ajukan KRS"),
        Step("decision", 1, "MK dipilih?"),
        Step("action", 0, "Pesan error", "Tidak"),
        Step("stop", 0, "", "Tidak"),
        Step("action", 1, "Cek duplikat\nSimpan Pending", "Ya"),
        Step("action", 0, "Notifikasi berhasil", "Ya"),
        Step("stop", 0, "", "Ya"),
    ]),
    Diagram("03-persetujuan-krs-dosen.png", "Diagram Persetujuan KRS Dosen", "Dosen", "Sistem", [
        Step("start", 0, ""),
        Step("action", 0, "Buka Persetujuan KRS"),
        Step("action", 1, "Filter KRS mahasiswa wali"),
        Step("action", 0, "Pilih pengajuan"),
        Step("decision", 0, "Setuju?"),
        Step("action", 1, "Update Disetujui", "Ya"),
        Step("stop", 0, "", "Ya"),
        Step("action", 1, "Update Ditolak", "Tidak"),
        Step("stop", 0, "", "Tidak"),
    ]),
    Diagram("04-input-nilai-dosen.png", "Diagram Input Nilai Dosen", "Dosen", "Sistem", [
        Step("start", 0, ""),
        Step("action", 0, "Pilih Mata Kuliah"),
        Step("action", 0, "Input komponen nilai"),
        Step("decision", 1, "Dikunci?"),
        Step("action", 0, "Pesan error", "Ya"),
        Step("stop", 0, "", "Ya"),
        Step("action", 1, "Hitung & simpan Pending", "Tidak"),
        Step("stop", 0, "", "Tidak"),
    ]),
    Diagram("05-validasi-nilai-kps.png", "Diagram Validasi Nilai KPS", "KPS", "Sistem", [
        Step("start", 0, ""),
        Step("action", 0, "Buka Validasi Nilai"),
        Step("action", 1, "Tampilkan daftar nilai"),
        Step("decision", 0, "Disetujui?"),
        Step("action", 1, "Status Disetujui", "Ya"),
        Step("stop", 0, "", "Ya"),
        Step("action", 1, "Status Ditolak", "Tidak"),
        Step("stop", 0, "", "Tidak"),
    ]),
    Diagram("06-kunci-nilai-global.png", "Diagram Kunci Nilai Global", "KPS", "Sistem", [
        Step("start", 0, ""),
        Step("action", 0, "Klik Kunci Semua Nilai"),
        Step("decision", 0, "Yakin?"),
        Step("action", 1, "kunci_nilai=1\ntanggal_kunci=now", "Ya"),
        Step("stop", 0, "", "Ya"),
        Step("stop", 0, "", "Tidak"),
    ]),
    Diagram("07-buka-kunci-nilai.png", "Diagram Buka Kunci Nilai", "KPS", "Sistem", [
        Step("start", 0, ""),
        Step("action", 0, "Menu Kunci Nilai"),
        Step("action", 0, "Klik Buka Kunci"),
        Step("decision", 0, "Yakin?"),
        Step("action", 1, "kunci_nilai=0\nNULL tanggal", "Ya"),
        Step("stop", 0, "", "Ya"),
        Step("stop", 0, "", "Tidak"),
    ]),
    Diagram("08-melihat-khs.png", "Diagram Melihat KHS", "Mahasiswa", "Sistem", [
        Step("start", 0, ""),
        Step("action", 0, "Buka Menu KHS"),
        Step("action", 1, "Nilai published\nHitung IPS/IPK"),
        Step("action", 0, "Tampilkan KHS"),
        Step("stop", 0, ""),
    ]),
    Diagram("09-export-pdf-khs.png", "Diagram Export PDF KHS", "Mahasiswa", "Sistem", [
        Step("start", 0, ""),
        Step("action", 0, "Klik Unduh PDF"),
        Step("action", 1, "Generate PDF DomPDF"),
        Step("action", 0, "Download file"),
        Step("stop", 0, ""),
    ]),
    Diagram("10-crud-mahasiswa.png", "Diagram CRUD Mahasiswa", "Admin", "Sistem", [
        Step("start", 0, ""),
        Step("action", 0, "Menu Mahasiswa"),
        Step("decision", 0, "Tambah/Edit/Hapus?"),
        Step("action", 1, "Create/Update/Delete"),
        Step("stop", 0, ""),
    ]),
    Diagram("11-crud-dosen.png", "Diagram CRUD Dosen", "Admin", "Sistem", [
        Step("start", 0, ""),
        Step("decision", 0, "Tambah/Edit/Hapus?"),
        Step("action", 1, "Proses CRUD Dosen"),
        Step("stop", 0, ""),
    ]),
    Diagram("12-crud-matkul.png", "Diagram CRUD Mata Kuliah", "Admin", "Sistem", [
        Step("start", 0, ""),
        Step("decision", 0, "Tambah/Edit/Hapus?"),
        Step("action", 1, "Proses CRUD Matkul"),
        Step("stop", 0, ""),
    ]),
    Diagram("13-pengaturan-sistem.png", "Diagram Pengaturan Sistem", "Admin", "Sistem", [
        Step("start", 0, ""),
        Step("action", 0, "Ubah pengaturan"),
        Step("decision", 1, "Valid?"),
        Step("action", 1, "Update PengaturanSistem", "Ya"),
        Step("stop", 0, "", "Ya"),
        Step("stop", 0, "", "Tidak"),
    ]),
    Diagram("14-laporan-krs.png", "Diagram Laporan KRS", "Admin", "Sistem", [
        Step("start", 0, ""),
        Step("action", 0, "Filter laporan"),
        Step("action", 1, "Tampilkan data KRS"),
        Step("decision", 0, "Export?"),
        Step("action", 1, "PDF / Excel", "Ya"),
        Step("stop", 0, ""),
    ]),
    Diagram("15-laporan-khs.png", "Diagram Laporan KHS", "Admin", "Sistem", [
        Step("start", 0, ""),
        Step("action", 0, "Filter laporan"),
        Step("action", 1, "Tampilkan data nilai"),
        Step("decision", 0, "Export?"),
        Step("action", 1, "PDF / Excel", "Ya"),
        Step("stop", 0, ""),
    ]),
]


def render_diagram(d: Diagram) -> None:
    fnt = font(11)
    title_fnt = font(14, True)
    lane_fnt = font(12, True)
    label_fnt = font(10)

    y = 80
    layout: list[tuple[int, int, int, Step]] = []
    for step in d.steps:
        if step.kind == "start":
            layout.append((y, 20, 20, step))
            y += 50
        elif step.kind == "stop":
            layout.append((y, 24, 24, step))
            y += 50
        elif step.kind == "decision":
            layout.append((y, 120, 70, step))
            y += 100
        else:
            bw, bh = box_size(step.text, fnt)
            layout.append((y, bw, bh, step))
            y += bh + 40

    H = max(y + 60, 550)
    img = Image.new("RGB", (W, H), BG)
    draw = ImageDraw.Draw(img)

    for x in range(0, W, 20):
        draw.line((x, 0, x, H), fill=GRID)
    for gy in range(0, H, 20):
        draw.line((0, gy, W, gy), fill=GRID)

    tw = title_fnt.getlength(d.title)
    draw.text(((W - tw) / 2, 15), d.title, fill=BORDER, font=title_fnt)

    draw.rectangle((0, 50, LANE_W, H), fill=LANE_BG, outline=LANE_LINE)
    draw.rectangle((LANE_W, 50, W, H), fill=LANE_BG, outline=LANE_LINE)
    draw.line((LANE_W, 50, LANE_W, H), fill=LANE_LINE, width=2)

    for i, name in enumerate([d.lane_left, d.lane_right]):
        cx = i * LANE_W + LANE_W // 2
        draw.text((cx - lane_fnt.getlength(name) / 2, 55), name, fill=BORDER, font=lane_fnt)

    prev: tuple[int, int] | None = None
    for yp, bw, bh, step in layout:
        cx = lane_center(step.lane, bw if step.kind == "action" else (120 if step.kind == "decision" else 24))
        cy = yp + bh // 2

        if step.kind == "start":
            draw.ellipse((cx - 10, yp, cx + 10, yp + 20), fill=START, outline=BORDER)
        elif step.kind == "stop":
            draw.ellipse((cx - 12, yp, cx + 12, yp + 24), outline=START, width=3)
            draw.ellipse((cx - 6, yp + 6, cx + 6, yp + 18), fill=START)
        elif step.kind == "decision":
            pts = [(cx, yp), (cx + 60, cy), (cx, yp + bh), (cx - 60, cy)]
            draw.polygon(pts, fill=ACTION, outline=BORDER)
            for i, line in enumerate(wrap_text(step.text, fnt, 100)):
                draw.text((cx - fnt.getlength(line) / 2, cy - 10 + i * 14), line, fill=BORDER, font=fnt)
        else:
            x0, y0 = cx - bw // 2, yp
            draw.rounded_rectangle((x0, y0, x0 + bw, y0 + bh), radius=12, fill=ACTION, outline=BORDER, width=2)
            for i, line in enumerate(wrap_text(step.text, fnt, bw - 20)):
                draw.text((cx - fnt.getlength(line) / 2, y0 + 10 + i * 15), line, fill=BORDER, font=fnt)

        if prev and step.kind != "start":
            px, py = prev
            draw.line((px, py, cx, yp if step.kind == "stop" else cy - bh // 2), fill=ARROW, width=2)
            if step.branch:
                lc = LABEL_YA if step.branch == "Ya" else LABEL_TIDAK
                draw.text(((px + cx) // 2, (py + cy) // 2 - 10), step.branch, fill=lc, font=label_fnt)

        if step.kind == "decision":
            prev = (cx, cy + 35)
        elif step.kind != "stop":
            prev = (cx, cy + (bh // 2 if step.kind != "start" else 10))
        else:
            prev = None

    out = OUT_DIR / d.filename
    img.save(out, "PNG", optimize=True)
    print(f"OK: {out}")


def main() -> None:
    for d in DIAGRAMS:
        render_diagram(d)
    print(f"\nGenerated {len(DIAGRAMS)} PNG files in {OUT_DIR}")


if __name__ == "__main__":
    main()
