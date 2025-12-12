<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Campaign</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-dark bg-dark p-3">
    <a class="navbar-brand text-white" href="#">Admin Panel</a>
</nav>

<div class="container mt-4">

    <h2 class="mb-4">Create Christmas Donation Campaign 🎄</h2>

    <form action="{{ route('admin.campaign.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Campaign Title</label>
            <input type="text" name="title" class="form-control" placeholder="Christmas Donation 2024">
            @error('title') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" rows="4" class="form-control"
                      placeholder="Explain why people should donate..."></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Start Date</label>
            <input type="date" name="start_date" class="form-control">
            @error('start_date') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">End Date</label>
            <input type="date" name="end_date" class="form-control">
            @error('end_date') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Banner Image</label>
            <input type="file" name="banner" class="form-control">
            @error('banner') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button class="btn btn-success px-4">Create Campaign</button>
    </form>

</div>

</body>
</html>
