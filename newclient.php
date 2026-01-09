<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Create Client</title>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <h2 class="mb-4">Create New Client</h2>

    <?php if (!empty($success)): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form action="saveclient.php" method="post" class="row g-3">

        <!-- Basic Client Info -->
        <div class="col-md-6">
            <label for="name" class="form-label">Name *</label>
            <input type="text" id="name" name="Name" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label for="phone" class="form-label">Phone Number *</label>
            <input type="text" id="phone" name="Phonenumber" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label for="email" class="form-label">Email *</label>
            <input type="email" id="email" name="Email" class="form-control" required>
        </div>

        <!-- Address Group -->
        <div class="col-12">
            <div class="card border-secondary mb-3">
                <div class="card-header bg-secondary text-white">Address</div>
                <div class="card-body row g-3">
                    <div class="col-md-6">
                        <label for="address1" class="form-label">Address 1 *</label>
                        <input type="text" id="address1" name="Address1" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label for="address2" class="form-label">Address 2</label>
                        <input type="text" id="address2" name="Address2" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label for="town" class="form-label">Town *</label>
                        <input type="text" id="town" name="Town" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label for="postcode" class="form-label">Postcode *</label>
                        <input type="text" id="postcode" name="Postcode" class="form-control" required>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-primary">Create Client</button>
        </div>

    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>