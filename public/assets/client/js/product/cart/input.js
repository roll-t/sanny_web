function handleInputProduct(){
    const product= new Product()
    const listProduct=product.listProduct
    listProduct.forEach(items=>{
        const input=new Input_1(items);
    })
}
handleInputProduct()