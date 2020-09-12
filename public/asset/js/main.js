


//navbar mob
$(document).ready(function(){
	$(".show-nav").click(function(){
		$(".left-sidebar").css({
			'display' : 'block',
			'width' : '100%'
		})
		$(".main-content").css({
			'display' : 'none',
		});
		$(".show-nav").hide();
		$(".hide-nav").show();
	})
	$(".hide-nav").click(function(){
		$(".left-sidebar").css({
			'display' : 'none',
			'width' : '0'
		})
		$(".main-content").css({
			'display' : 'block',
			'width' : '100%'

		});
		$(".show-nav").show();
		$(".hide-nav").hide();
	})
})


//show table 
$(document).ready(function(){
	$(".show-table").click(function(){
		$(".hotel-boy").slideToggle();
	})
})


//filtering row
$(document).ready(function(){
	$(".filter-item").click(function(){
		var selectItem 	= $(this).attr('id');
		var selectRow 	= $(this).attr('id');
		if( selectItem != 'all' ){
			$(".filter-item").removeClass("active-item");
			$("." + selectItem).addClass("active-item");
		}
		if( selectRow != 'all' ){
			$(".filter-row").removeClass("active-row");
			$(".filter-row").removeClass("active-item");
			$("." + selectRow).addClass("active-row");
		}
	})
})


// Script for dashboard

const add = document.getElementsByClassName('add-qt');
const quantity = document.getElementsByClassName('quantity-taker')
let selectedFoodItems = []

for(let index in add){
	add[index].onclick = e => {
		let item = e.target.dataset.food
		let qty = parseInt(quantity[index].value)
		let name = e.target.dataset.name
		let ob = {
			item,
			qty,
			name
		}
		let exist = false

		selectedFoodItems.filter((value,index) => {
			if(value.item == item){
				selectedFoodItems[index].qty += qty
				exist = true
			}
		})

		if(!exist){
			selectedFoodItems.push(ob)
		}

		document.getElementById('itemsss').innerHTML = ''
		selectedFoodItems.forEach(e => {
			document.getElementById('itemsss').innerHTML += `
			
								<div class="row itemss" style="display: flex;flex-wrap: wrap;">
                                    <div class="col-6" style="flex: 0 0 50%;max-width: 50%;">
                                        <p style="font-size: 12px;">
                                            <span class="badge badge-dark cross" data-item="${e.item}" style="cursor: pointer;margin-right:5px;">(x)</span> ${e.name}
                                        </p>
                                    </div>

                                    <div class="col-6" style="flex: 0 0 50%;max-width: 50%;">
                                        <p class="text-right" style="font-size: 12px; text-align:right;">
                                            ${e.qty}
                                        </p>
                                    </div>
                                </div>
			
			`
		})
		fu()
	}
}







document.getElementById('printQt').onclick = () => {
	axios.post('/api/order', {food:selectedFoodItems, table: table})
	.then(res => {
		
		let x = document.getElementById('qt').innerHTML
		let y = window.open(' ', '_parent')
		y.document.write(x)
		y.print()
		window.location.reload()
	})
	.catch(err => {
		console.log(err)
	})
	.then(e => {
		window.location.reload()
	})
	

}




let cross = document.getElementsByClassName('cross')
let itemss = document.getElementsByClassName('itemss')


function fu(){
	cross = document.getElementsByClassName('cross')
	itemss = document.getElementsByClassName('itemss')


	for(let i in cross){

		cross[i].onclick = e => {
			console.log(e)
			let itemId = e.target.dataset.item
			selectedFoodItems.filter( (value, index) => {
				if(value.item == itemId){
					selectedFoodItems.splice(index,1)
					itemss[i].remove()
					fu()

				}
			})
		}
	}

}


