<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donate</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Make a Donation</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('store_donationLists') }}" method="POST" id="donationForm">
        @csrf
        <div class="mb-3">
            <label for="full_name" class="form-label">Full Name</label>
            <input type="text" name="full_name" id="full_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Type of Donation</label>
            <select name="type" id="type" class="form-select" required>
                <option value="">Select Type</option>
                <option value="toys">Toys</option>
                <option value="clothing">Clothing</option>
                <option value="surprise_gift">Surprise Gift</option>
                <option value="money">Money</option>
            </select>
        </div>

        <div class="mb-3" id="amountDiv" style="display:none;">
            <label for="amount" class="form-label">Amount (NPR)</label>
            <input type="number" name="amount" id="amount" class="form-control" min="10" placeholder="Enter amount">
        </div>

        <button type="submit" class="btn btn-primary">Donate Now</button>
    </form>
</div>

<script>
    const typeSelect = document.getElementById('type');
    const amountDiv = document.getElementById('amountDiv');

    typeSelect.addEventListener('change', function() {
        if (this.value === 'money') {
            amountDiv.style.display = 'block';
        } else {
            amountDiv.style.display = 'none';
        }
    });
</script>
</body>
</html>
