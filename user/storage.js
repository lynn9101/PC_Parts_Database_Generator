
const updateFilterVisual = () => {
    dropdown = document.getElementById("storageType");
    ff = document.getElementById("ff");
    rpm = document.getElementById("RPM");
    min = document.getElementById("RPMmin");
    max = document.getElementById("RPMmax");

    if(dropdown.value == 0){
        ff.hidden = true;
        rpm.hidden = true;
        console.log(RPMmin)
    }else if(dropdown.value == 1){
        ff.hidden = false;
        rpm.hidden = true;
        min = RPMmin;
        max = RPMmax;
    }else if(dropdown.value == 2){
        ff.hidden = true;
        rpm.hidden = false;
    }else{
        console.log("?");
    }
}

window.onload=function(){
    dropdown = document.getElementById("storageType");
    dropdown.addEventListener('change', updateFilterVisual);
    updateFilterVisual();
}