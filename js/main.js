$(document).ready(function(){
    //product data insertion..
    $("#insert-product-data").click(function(){
        let name, description, discount, section;
        let price = document.getElementById("price");
        name = document.getElementById("name");
        section = document.getElementById("section");
        description = document.getElementById("description");
        discount = document.getElementById("discount");
        if (name.value == "" || price.value == 0 || description.value == "") {
            alert('Input fields must be filled out');
        } else {
            $.ajax({
                type: "post",
                url: "insertProduct.php",
                data: {
                    name: name.value,
                    price: price.value,
                    description: description.value,
                    discount: discount.value
                },
                success: function(res){
                    name.value = "";
                    price.value = "";
                    description.value = "";
                    discount.value = "";
                    alert(res);
                }
            })
        }
    })
})
