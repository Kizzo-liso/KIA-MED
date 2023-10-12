
var menuItem = document.querySelectorAll('.item-menu')

function seletor(){
    menuItem.forEach((item)=>
        item.classList.remove('ativo')
    )
    this.classList.add('ativo')
}
menuItem.forEach((item)=>
    item.addEventListener('click',seletor)
)

//expandir menu
var bntexp = document.querySelector('#bnt-exp');
var menuside = document.querySelector('.menu-lateral');

bntexp.addEventListener('click', function() {
    menuside.classList.toggle('expandir');
});
