const displayValues = 
["Current Selection", "Motherboard", "Memory", "SSD Storage", "HDD Storage", "Cooling System",
"Central Processing Unit", "Graphics Card", "Case", "Power Supply"]

const imgValues =
["None", "motherboard", "memory", "storage", "storage", "cooling",
"cpu", "gpu", "case", "power-supply"]

const changeDisplay = () => {
    component = document.getElementById("selection");
    textDisplay = document.getElementById("selection-label");
    visual = document.getElementById("visual")
    console.log(component.value);
    btn = document.getElementById("btn");
    btn2 = document.getElementById("btn2");
    
    textDisplay.innerHTML = displayValues[component.value];
    visual.src = "../images/" + imgValues[component.value] + "-logo.png";
    if(component.value == 0) {
        visual.src = "../images/components wallpaper.jpg";
        btn.disabled = true
        btn2.disabled = true
    }else {
        btn.disabled = false
        btn2.disabled = false
    }
}

window.onload=function(){
    component = document.getElementById("selection");
    component.addEventListener('change', changeDisplay);
    changeDisplay()
}
