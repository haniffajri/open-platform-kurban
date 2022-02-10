// checkbox term condition in checkout page

function onClickTermConditinStatus() {
    if(document.getElementById("id-term-condition-custom").checked === true){
        document.getElementById("place_order").style.display = "block"
        document.getElementById("place_order_custom").style.display = "none"
    } else {
        document.getElementById("place_order").style.display = "none"
        document.getElementById("place_order_custom").style.display = "block"
    }
}