<?php



?>

<script>
    var cashRegister = {
        total:0,
        lastTransactionAmount:0,
        //Dont forget to add your property
        add: function(itemCost) {
            this.total +=  itemCost;
            this.lastTransactionAmount = itemCost;
        },
        voidLastTransaction: function(){

        }
        scan: function(item,quantity) {
            switch (item) {
                case "eggs": this.add(0.98 * quantity); break;
                case "milk": this.add(1.23 * quantity); break;
                case "magazine": this.add(4.99 * quantity); break;
                case "chocolate": this.add(0.45 * quantity); break;
            }
            return true;
        },
        //Add the voidLastTransaction Method here


    };

    cashRegister.scan('eggs',3);
    cashRegister.scan('milk',3);
    cashRegister.scan('magazine',3);
    cashRegister.scan('chocolate',3);

    //Void the last transaction and then add 3 instead


    //Show the total bill
    console.log('Your bill is '+cashRegister.total);
</script>