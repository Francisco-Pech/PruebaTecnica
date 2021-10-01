function ProductsList(node){
    this.products=[];
    this.addProduct=(barCode)=>{
        fetch("http://localhost:8000"+`/groupproduct/code?barCode=${barCode}&&includeProducts=true`)
        .then(response => response.json())
        .then(data =>{
            this.products=[...this.products,data.id]
            this.addLi(data);
        }).catch(err=>{
            console.log(err)
        });
    }
    this.render=(productSale)=>{
        console.log(productSale); 
        productSale.forEach(()=>{
            
        })
    }
    this.addLi=(item)=>{
        let liNode = document.createElement("li");
        console.log(item);
        liNode.setAttribute("class","list-group-item product")
        liNode.setAttribute("data-group-id",item.id)
        // liNode.innerHTML=/*html*/`<span>${item.name}</span>`
        liNode.innerHTML=/*html*/`  
        <a href="#" class="list-group-item list-group-item-action" aria-current="true">
        <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">${item.name}</h5>
            <b>Precio al público: $${item.public_price}</b>
        </div>
            <p class="mb-1">
            ${item.active_substance}
            </p>
        <small><b>${item.presentation}</b></small>
        </a>`
        +
        // +
        this.getDropdown(item.products,item.id,this.products.length)
        +
        /*html*/`<button type="button" class="close" aria-label="Close" onClick="deleteProduct(this)">
            <span aria-hidden="true">&times;</span>
        </button>`

        node.appendChild(liNode);
    }
    this.getDropdown=(items,groupId,index)=>{
        const reducer=(accumulator,item)=>{
            return accumulator+/*html*/ `<option  data-groupId="${groupId}" value="${item.date_of_expiry}">${item.date_of_expiry}</option>`
        }
        const dropdownOptions=items.reduce(reducer,'');

        const dropdown = /*html*/`<select id="${index}" data-groupId="${groupId}" class="custom-select product-select">
        <option selected>selecciona fecha de expiración</option>`+dropdownOptions+/*html*/`</select>`

        return dropdown;
    }
    this.deleteProduct=(element)=>{
        //get grup id
        let groupId = element.parentNode.getAttribute("data-group-id");

        //delete product id from product array
        let index=this.products.indexOf(Number(groupId));
        if (index > -1) {
            this.products.splice(index, 1);
        }
        //delete li object
        element.parentNode.remove()
    }
    this.sell=()=>{
        let products=document.querySelectorAll(".product-select");
        let sellProducts=[];
        products.forEach(product=>{
            let selectElement = product
            let dateofExpire = selectElement.value;
            let groupId=selectElement.getAttribute("data-groupId");
            sellProducts.push({groupId,dateofExpire})
        })
        console.log(sellProducts);
        // send sell request
        fetch('http://localhost:8000/sales/sell', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({products:sellProducts})
        })
        .then(response => response.json())
        .then(data =>{

        } ).catch(err=>{
            console.log(err)
        });
    }
    this.pausedSale=()=>{
        let products=document.querySelectorAll(".product-select");
        let sellProducts=[];
        products.forEach(product=>{
            let selectElement = product
            let dateofExpire = selectElement.value;
            let groupId=selectElement.getAttribute("data-groupId");
            sellProducts.push({groupId,dateofExpire})
        })

        fetch('http://localhost:8000/salesPaused', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({products:sellProducts})
        })
        .then(response => location.reload())
        .catch(err=>{
            console.log(err)
        });

    }
}


