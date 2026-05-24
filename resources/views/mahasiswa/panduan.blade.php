@extends('layouts.mahasiswa')

@section('content')

<div class="container-panduan">

    <div class="content">

        <h2 class="panduan-title">
            Cara Mengisi KRS
        </h2>

        <div class="steps">

            <div class="step">
                ✔ Pilih Semester
            </div>

            <div class="step">
                ✔ Pilih Mata Kuliah
            </div>

            <div class="step">
                ✔ Klik Submit
            </div>

        </div>

        <div class="accordion">

            <div class="accordion-item">

                <button class="accordion-header">
                    Apa itu KRS?
                    <span class="arrow">▼</span>
                </button>

                <div class="accordion-body">
                    KRS atau Kartu Rencana Studi merupakan
                    rencana mata kuliah yang akan diambil
                    mahasiswa pada satu semester.
                </div>

            </div>

            <div class="accordion-item">

                <button class="accordion-header">
                    Maksimal SKS yang bisa diambil
                    <span class="arrow">▼</span>
                </button>

                <div class="accordion-body">
                    Maksimal SKS biasanya tergantung
                    IP semester sebelumnya.
                </div>

            </div>

            <div class="accordion-item">

                <button class="accordion-header">
                    Apakah KRS bisa diubah setelah disimpan?
                    <span class="arrow">▼</span>
                </button>

                <div class="accordion-body">
                    Bisa, selama masih dalam periode
                    pengisian KRS.
                </div>

            </div>

        </div>

    </div>

</div>

<script>

const acc = document.querySelectorAll(".accordion-header");

acc.forEach(btn => {

    btn.addEventListener("click", function () {

        acc.forEach(item => {

            if(item !== this){

                item.classList.remove("active");
                item.nextElementSibling.style.maxHeight = null;

            }

        });

        this.classList.toggle("active");

        const body = this.nextElementSibling;

        if(body.style.maxHeight){

            body.style.maxHeight = null;

        } else {

            body.style.maxHeight =
                body.scrollHeight + "px";

        }

    });

});

</script>

@endsection