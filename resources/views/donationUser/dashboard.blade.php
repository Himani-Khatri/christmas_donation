<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Christmas Donation Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://khalti.com/static/khalti-checkout.js"></script>
</head>
<body>

<div class="container my-5">
    <h2>🎁 Make a Donation</h2>
    <form id="donationForm">
        @csrf
        <div class="mb-3">
            <label>Full Name</label>
            <input type="text" class="form-control" id="full_name" placeholder="Enter your full name" required>
        </div>

        <div class="mb-3">
            <label>Type of Donation</label>
            <select id="type" class="form-select" required>
                <option value="">Select Type</option>
                <option value="money">💰 Money</option>
                <option value="toys">🧸 Toys</option>
                <option value="clothing">👕 Clothing</option>
                <option value="surprise_gift">🎁 Surprise Gift</option>
            </select>
        </div>

        <div class="mb-3" id="amountDiv" style="display:none;">
            <label>Amount (NPR)</label>
            <input type="number" id="amount" class="form-control" min="10" placeholder="Enter amount">
        </div>

        <button type="button" class="btn btn-primary" id="payBtn">💳 Proceed to Payment</button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const typeSelect = document.getElementById('type');
    const amountDiv = document.getElementById('amountDiv');
    const amountInput = document.getElementById('amount');
    const fullNameInput = document.getElementById('full_name');
    const payBtn = document.getElementById('payBtn');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Show/hide amount field
    typeSelect.addEventListener('change', function(){
        if(typeSelect.value === 'money'){
            amountDiv.style.display = 'block';
            amountInput.setAttribute('required', 'required');
        } else {
            amountDiv.style.display = 'none';
            amountInput.removeAttribute('required');
            amountInput.value = '';
        }
    });

    const khaltiKey = "{{ $khaltiKey }}";
    if(!khaltiKey){ alert("❌ Khalti public key missing"); return; }

    const checkout = new KhaltiCheckout({
        publicKey: khaltiKey,
        productIdentity: "donation_temp",
        productName: "Christmas Donation",
        productUrl: window.location.href,
        eventHandler: {
            onError: function(err){
                Swal.fire('❌ Payment failed', err.message || 'Unknown error', 'error');
                payBtn.disabled = false;
                payBtn.innerHTML = "💳 Proceed to Payment";
            },
            onClose: function(){ console.log("Khalti widget closed"); }
        },
        paymentPreference: ["KHALTI","EBANKING","MOBILE_BANKING","CONNECT_IPS","SCT"]
    });

    payBtn.addEventListener('click', function(){
        const fullName = fullNameInput.value.trim();
        const donationType = typeSelect.value;
        const amount = amountInput.value;

        if(!fullName){ Swal.fire('⚠️ Warning','Enter full name','warning'); fullNameInput.focus(); return; }
        if(!donationType){ Swal.fire('⚠️ Warning','Select donation type','warning'); typeSelect.focus(); return; }
        if(donationType === "money" && (!amount || parseInt(amount) < 10)){ Swal.fire('⚠️ Warning','Minimum amount is NPR 10','warning'); amountInput.focus(); return; }

        payBtn.disabled = true;
        payBtn.innerHTML = "⏳ Processing...";

        // Step 1: Create donation in backend
        fetch("{{ route('store_donationLists') }}", {
            method:"POST",
            headers:{
                "Content-Type":"application/json",
                "Accept":"application/json",
                "X-CSRF-TOKEN": csrfToken
            },
            body: JSON.stringify({
                full_name: fullName,
                type: donationType,
                amount: donationType==="money"?amount:null
            })
        })
        .then(res => res.json())
        .then(data => {
            if(!data.success) throw new Error(data.message || "Donation creation failed");

            if(donationType === "money"){
                const donationId = data.donation_id;
                const amountInPaisa = parseInt(amount) * 100;

                checkout.show({
                    amount: amountInPaisa,
                    productIdentity: "donation_" + donationId,
                    productName: "Christmas Donation",
                    productUrl: window.location.href,
                    eventHandler: {
                        onSuccess: function(payload){
                            // Step 2: Verify payment
                            fetch("{{ route('khalti.verify') }}", {
                                method:"POST",
                                headers:{
                                    "Content-Type":"application/json",
                                    "Accept":"application/json",
                                    "X-CSRF-TOKEN": csrfToken
                                },
                                body: JSON.stringify({
                                    token: payload.token,
                                    amount: amountInPaisa,
                                    donation_id: donationId
                                })
                            })
                            .then(r => r.json())
                            .then(resp => {
                                if(resp.success){
                                    Swal.fire('✅ Success','Payment Successful!','success').then(() => location.reload());
                                } else {
                                    Swal.fire('❌ Verification failed', resp.message || 'Unknown error','error');
                                    payBtn.disabled = false;
                                    payBtn.innerHTML = "💳 Proceed to Payment";
                                }
                            })
                            .catch(err => {
                                Swal.fire('❌ Verification error','Contact support','error');
                                payBtn.disabled = false;
                                payBtn.innerHTML = "💳 Proceed to Payment";
                            });
                        },
                        onError: function(err){
                            Swal.fire('❌ Payment failed', err.message || 'Unknown error','error');
                            payBtn.disabled = false;
                            payBtn.innerHTML = "💳 Proceed to Payment";
                        },
                        onClose: function(){
                            payBtn.disabled = false;
                            payBtn.innerHTML = "💳 Proceed to Payment";
                        }
                    }
                });
            } else {
                Swal.fire('✅ Success','Donation submitted successfully!','success').then(()=> location.reload());
            }
        })
        .catch(err => {
            Swal.fire('❌ Error', err.message, 'error');
            payBtn.disabled = false;
            payBtn.innerHTML = "💳 Proceed to Payment";
        });
    });
});

</script>
</body>
</html>
