
const modal = document.getElementById("khsModal");
const btn = document.getElementById("openModal");
const close = document.querySelector(".close");

btn.onclick = function() {
    modal.style.display = "block";
}

close.onclick = function() {
    modal.style.display = "none";
}

window.onclick = function(e) {
    if (e.target == modal) {
        modal.style.display = "none";
    }
}

function exportPDF() {

    document
        .querySelectorAll('.no-print')
        .forEach(el => el.style.display = 'none');

    const element =
        document.getElementById('pdfContent');

    html2pdf()
        .set({
            margin: 12,
            filename: 'KHS.pdf',

            image: {
                type: 'jpeg',
                quality: 1
            },

            html2canvas: {
                scale: 2
            },

            jsPDF: {
                unit: 'mm',
                format: 'a4',
                orientation: 'portrait'
            }
        })
        .from(element)
        .save()
        .then(() => {

            document
                .querySelectorAll('.no-print')
                .forEach(el => el.style.display = 'block');

        });
}