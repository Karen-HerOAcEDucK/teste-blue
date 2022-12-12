const inventoryIndexElements = {
    tableItems: document.getElementById('table-items'),
    btnExportItem: document.getElementById('btn-export-item'),
    tableBodyItems: document.getElementById('table-body-item'),
    btnsDeleteItem: document.querySelectorAll('.btn-delete-item'),
}

for(const btnDeleteItem of inventoryIndexElements.btnsDeleteItem){
    btnDeleteItem.addEventListener('click', (e) => {
        if(!confirm('Deseja realmente excluir este item?')){
            e.preventDefault()
        }
    })
}