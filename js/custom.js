	/// Custom 
	const credito = document.querySelector('.pago__credito');
	const method = document.querySelector('.pay-method');
    
    

    method.addEventListener('change',(e)=>{
         method.value == 'A credito' ?  credito.classList.add('active') : credito.classList.remove('active')
    });