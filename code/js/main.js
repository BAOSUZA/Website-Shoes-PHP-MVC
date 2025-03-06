let nav = document.getElementById('header');
let items = document.querySelectorAll('.item');
let itemsTab = document.querySelectorAll('.itemTab');
document.addEventListener('scroll', (event) => {
    if (window.scrollY > 400) {
        nav.classList.add('toFixed');
    } else {
        nav.classList.remove('toFixed');
    }
    items.forEach(item => {
        if (item.offsetTop - window.scrollY < 700) {
            item.classList.add('active');
        }
    })
    itemsTab.forEach(itemTab => {
        if (itemTab.offsetTop - window.scrollY < 600) {
            itemTab.classList.add('activeTab');
        }
    })
})



// kiểm tra checkbox giỏ hàng
let check = document.querySelectorAll('.checkboxCart');
let checkkq = document.querySelector('.idOrderDetail');
var resultCheck = "";
check.forEach(element => {
    element.onclick = function (e) {
        if (this.checked) {
            resultCheck = resultCheck + element.value + " ";
            checkkq.value = resultCheck + " ";
        }
        else {
            resultCheck = resultCheck.replace(element.value, "") + " ";
            checkkq.value = resultCheck + " ";
        }
    };
});

// chọn toàn bộ checkbox giỏ hàng
let checkAll = document.querySelector('.checkboxCartAll')
checkAll.onclick = function (e) {
    if (this.checked) {
        check.forEach(element => {
            element.checked = true;
            element.onclick = function () {
                if (this.checked) {
                    
                }else {
                    checkAll.checked = false;
                }
            };
        });
    }else {
        check.forEach(element => {
            element.checked = false;
        });
    }
}


// thay đổi số lượng chi tiết sản phẩm

// let qtyDec = document.querySelector('.dec');
// let qtyInc = document.querySelector('.inc');
// let qtyPro = document.querySelector('.amount-product');

// qtyDec.addEventListener('click', () => {
//     qtyPro.value = qtyPro.value - 1;
// })

// qtyInc.addEventListener('click', () => {
//     qtyPro.value = Number(qtyPro.value) + 1;
// })