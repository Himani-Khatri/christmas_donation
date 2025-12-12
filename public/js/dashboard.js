const typeSelect = document.getElementById('type');
const amountDiv = document.getElementById('amountDiv');
const amountInput = document.getElementById('amount');
const fakePayBtn = document.getElementById('fakePayBtn');
const modal = document.getElementById('paymentModal');
const confirmPayment = document.getElementById('confirmPayment');
const cancelPayment = document.getElementById('cancelPayment');
const displayAmount = document.getElementById('displayAmount');

const cardNumber = document.getElementById('cardNumber');
const cardExpiry = document.getElementById('cardExpiry');
const cardCVV = document.getElementById('cardCVV');

typeSelect.addEventListener('change', () => {
    amountDiv.style.display = typeSelect.value === 'money' ? 'block' : 'none';
});

cardNumber.addEventListener('input', (e) => {
    let value = e.target.value.replace(/\s/g, '');
    let formattedValue = value.match(/.{1,4}/g)?.join(' ') || value;
    e.target.value = formattedValue;
});

cardExpiry.addEventListener('input', (e) => {
    let value = e.target.value.replace(/\D/g, '');
    if (value.length >= 2) {
        value = value.slice(0, 2) + '/' + value.slice(2, 4);
    }
    e.target.value = value;
});

cardCVV.addEventListener('input', (e) => {
    e.target.value = e.target.value.replace(/\D/g, '');
});

fakePayBtn.addEventListener('click', () => {
    if(typeSelect.value === '') {
        alert("Please select a donation type!");
        return;
    }
    
    if(typeSelect.value === 'money') {
        if(amountInput.value === '' || amountInput.value < 10) {
            alert("Please enter a valid amount (minimum NPR 10)!");
            return;
        }
        displayAmount.textContent = amountInput.value;
    } else {
        displayAmount.textContent = 'N/A';
    }
    
    modal.style.display = "flex";
});

cancelPayment.addEventListener('click', () => {
    modal.style.display = "none";
    clearCardInputs();
});

confirmPayment.addEventListener('click', () => {
    if(typeSelect.value === 'money') {
        if(cardNumber.value.replace(/\s/g, '').length < 16) {
            alert("Please enter a valid card number!");
            return;
        }
        if(cardExpiry.value.length < 5) {
            alert("Please enter a valid expiry date!");
            return;
        }
        if(cardCVV.value.length < 3) {
            alert("Please enter a valid CVV!");
            return;
        }
    }
    
    confirmPayment.innerHTML = '<span style="display: inline-block; animation: spin 1s linear infinite;">⏳</span> Processing...';
    confirmPayment.disabled = true;
    
    setTimeout(() => {
        alert("Payment Successful! 🎉 Thank you for your generous donation!");
        modal.style.display = "none";
        clearCardInputs();
        document.getElementById('donationForm').submit();
    }, 2000);
});

function clearCardInputs() {
    cardNumber.value = '';
    cardExpiry.value = '';
    cardCVV.value = '';
    document.getElementById('cardName').value = '';
    confirmPayment.innerHTML = 'Pay Now';
    confirmPayment.disabled = false;
}

modal.addEventListener('click', (e) => {
    if(e.target === modal) {
        modal.style.display = "none";
        clearCardInputs();
    }
});

const style = document.createElement('style');
style.textContent = `
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
`;
document.head.appendChild(style);