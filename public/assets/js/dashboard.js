const sidebar =
document.getElementById('sidebar');

const menuBtn =
document.getElementById('menuBtn');

if(menuBtn){

    menuBtn.addEventListener('click',()=>{

        sidebar.classList.toggle('active');
    });
}

Toastify({

    text:"Dashboard Nature cargado correctamente",

    duration:3000,

    gravity:"top",

    position:"right",

    style:{

        background:
        "linear-gradient(to right,#2563eb,#7c3aed)"
    }

}).showToast();
