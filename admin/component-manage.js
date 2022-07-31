const displayText = ["Current Selection",]

const changeDisplay = () => {
    component = document.getElementById("selection")
    
    console.log(component.value)
}

window.onload=function(){
    component = document.getElementById("selection")
    component.addEventListener('change', changeDisplay)
}
