const btnDomestic = document.getElementById('btnDomestic');
const btnInternational = document.getElementById('btnInternational');
const domesticRoutes = document.getElementById('domesticRoutes');
const internationalRoutes = document.getElementById('internationalRoutes');

btnDomestic.addEventListener('click', () => {
    btnDomestic.classList.replace('btn-outline-primary', 'btn-primary');
    btnInternational.classList.replace('btn-primary', 'btn-outline-primary');

    domesticRoutes.classList.remove('d-none');
    internationalRoutes.classList.add('d-none');
});

btnInternational.addEventListener('click', () => {
    btnInternational.classList.replace('btn-outline-primary', 'btn-primary');
    btnDomestic.classList.replace('btn-primary', 'btn-outline-primary');

    internationalRoutes.classList.remove('d-none');
    domesticRoutes.classList.add('d-none');
});