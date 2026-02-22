<?php include __DIR__ . '/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/css/style.css">
	<title>Admin Dashboard</title>
	<style>
		.admin-container {
			max-width: 1200px;
			margin: 20px auto;
			padding: 20px;
		}
		.admin-card {
			background: #f5f5f5;
			border-radius: 8px;
			padding: 20px;
			margin-bottom: 20px;
		}
		.admin-grid {
			display: grid;
			grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
			gap: 15px;
		}
		.admin-table {
			width: 100%;
			border-collapse: collapse;
		}
		.admin-table th, .admin-table td {
			border: 1px solid #ddd;
			padding: 8px;
			text-align: left;
		}
		.admin-table th {
			background: #eee;
		}
		.form-group {
			margin-bottom: 10px;
		}
		.form-group label {
			display: block;
			margin-bottom: 5px;
			font-weight: bold;
		}
		.form-group input, .form-group select, .form-group textarea {
			width: 100%;
			padding: 8px;
			border-radius: 4px;
			border: 1px solid #ccc;
		}
		.btn {
			background: #4CAF50;
			color: white;
			padding: 10px 16px;
			border: none;
			border-radius: 4px;
			cursor: pointer;
		}
		.btn-danger {
			background: #f44336;
		}
		.message {
			padding: 10px;
			border-radius: 4px;
			margin-bottom: 15px;
		}
		.message.success {
			background: #e7f5e7;
			color: #2d7a2d;
		}
		.message.error {
			background: #fdecea;
			color: #a94442;
		}
	</style>
</head>
<body>
	<div class="admin-container">
		<h1>Admin Dashboard</h1>

		<?php if (isset($_SESSION['admin_message'])): ?>
			<div class="message success"><?php echo htmlspecialchars($_SESSION['admin_message']); ?></div>
			<?php unset($_SESSION['admin_message']); ?>
		<?php endif; ?>

		<?php if (isset($_SESSION['admin_error'])): ?>
			<div class="message error"><?php echo htmlspecialchars($_SESSION['admin_error']); ?></div>
			<?php unset($_SESSION['admin_error']); ?>
		<?php endif; ?>

		<div class="admin-card">
			<h2>Film Management</h2>
			<div class="admin-grid">
				<form method="POST" action="/admin/films/add">
					<h3>Add Film</h3>
					<div class="form-group">
						<label for="addFilmId">Film ID (optional)</label>
						<input type="text" name="filmId" id="addFilmId">
					</div>
					<div class="form-group">
						<label for="addFilmTitle">Title</label>
						<input type="text" name="filmTitle" id="addFilmTitle" required>
					</div>
					<div class="form-group">
						<label for="addFilmAuthor">Author</label>
						<input type="text" name="filmAuthor" id="addFilmAuthor">
					</div>
					<div class="form-group">
						<label for="addFilmDetail">Detail</label>
						<textarea name="filmDetail" id="addFilmDetail" rows="3"></textarea>
					</div>
					<div class="form-group">
						<label for="addFilmCategory">Category</label>
						<input type="text" name="filmCategory" id="addFilmCategory">
					</div>
					<div class="form-group">
						<label for="addFilmTime">Duration (minutes)</label>
						<input type="number" name="filmTime" id="addFilmTime" min="1">
					</div>
					<div class="form-group">
						<label for="addFilmPoster">Poster (filename)</label>
						<input type="text" name="filmPoster" id="addFilmPoster">
					</div>
					<button class="btn" type="submit">Add Film</button>
				</form>

				<form method="POST" action="/admin/films/update">
					<h3>Update Film</h3>
					<div class="form-group">
                        <label for="updateFilmId">Film ID *</label>
                        <input type="text" name="filmId" id="updateFilmId" required>
                    </div>
                    <div class="form-group">
                        <label for="updateFilmTitle">Title</label>
                        <input type="text" name="filmTitle" id="updateFilmTitle">
                    </div>
                    <div class="form-group">
                        <label for="updateFilmAuthor">Author</label>
                        <input type="text" name="filmAuthor" id="updateFilmAuthor">
                    </div>
                    <div class="form-group">
                        <label for="updateFilmDetail">Detail</label>
                        <textarea name="filmDetail" id="updateFilmDetail" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="updateFilmCategory">Category</label>
                        <input type="text" name="filmCategory" id="updateFilmCategory">
                    </div>
                    <div class="form-group">
                        <label for="updateFilmTime">Duration (minutes)</label>
                        <input type="number" name="filmTime" id="updateFilmTime" min="1">
                    </div>
                    <div class="form-group">
                        <label for="updateFilmPoster">Poster (filename)</label>
                        <input type="text" name="filmPoster" id="updateFilmPoster">
                    </div>
                    <div style="margin-bottom: 10px;">
                        <small>Only fill fields you want to update. Leave empty to keep existing values.</small>
                    </div>
                    <button class="btn" type="submit">Update Film</button>
                </form>

				<form method="POST" action="/admin/films/delete">
					<h3>Delete Film</h3>
					<div class="form-group">
						<label for="deleteFilmId">Film ID</label>
						<input type="text" name="filmId" id="deleteFilmId" required>
					</div>
					<button class="btn btn-danger" type="submit">Delete Film</button>
				</form>
			</div>
		</div>

		<div class="admin-card">
			<h2>Sceance Management</h2>
			<div class="admin-grid">
				<form method="POST" action="/admin/sceances/add">
					<h3>Add Sceance</h3>
					<div class="form-group">
						<label for="sceanceId">Sceance ID (optional)</label>
						<input type="text" name="sceanceId" id="sceanceId">
					</div>
					<div class="form-group">
						<label for="sceanceDate">Date</label>
						<input type="datetime-local" name="sceanceDate" id="sceanceDate" required>
					</div>
					<div class="form-group">
						<label for="sceanceFilmId">Film</label>
						<select name="filmId" id="sceanceFilmId" required>
							<option value="">Select a film</option>
							<?php foreach ($films as $film): ?>
								<option value="<?php echo htmlspecialchars($film['filmId']); ?>">
									<?php echo htmlspecialchars($film['filmTitle']); ?>
								</option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<label for="sceanceRoomId">Room</label>
						<select name="roomId" id="sceanceRoomId" required>
							<option value="">Select a room</option>
							<?php foreach ($rooms as $room): ?>
								<option value="<?php echo htmlspecialchars($room['roomId']); ?>">
									Room <?php echo htmlspecialchars($room['roomId']); ?> - <?php echo htmlspecialchars($room['roomCharacteristic']); ?>
								</option>
							<?php endforeach; ?>
						</select>
					</div>
					<button class="btn" type="submit">Add Sceance</button>
				</form>

				<form method="POST" action="/admin/sceances/delete">
					<h3>Delete Sceance</h3>
					<div class="form-group">
						<label for="deleteSceanceId">Sceance ID</label>
						<input type="text" name="sceanceId" id="deleteSceanceId" required>
					</div>
					<button class="btn btn-danger" type="submit">Delete Sceance</button>
				</form>
			</div>
		</div>

		<div class="admin-card">
			<h2>Films List</h2>
			<table class="admin-table">
				<thead>
					<tr>
						<th>Film ID</th>
						<th>Title</th>
						<th>Author</th>
						<th>Category</th>
						<th>Duration (min)</th>
						<th>Poster</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($films as $film): ?>
						<tr>
							<td><strong><?php echo htmlspecialchars($film['filmId']); ?></strong></td>
							<td><?php echo htmlspecialchars($film['filmTitle']); ?></td>
							<td><?php echo htmlspecialchars($film['filmAuthor']); ?></td>
							<td><?php echo htmlspecialchars($film['filmCategory']); ?></td>
							<td><?php echo htmlspecialchars($film['filmTime']); ?></td>
							<td><?php echo htmlspecialchars($film['filmPoster']); ?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>

		<div class="admin-card">
			<h2>Users</h2>
			<table class="admin-table">
				<thead>
					<tr>
						<th>User ID</th>
						<th>Email</th>
						<th>Admin</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($users as $user): ?>
						<tr>
							<td><?php echo htmlspecialchars($user['userId']); ?></td>
							<td><?php echo htmlspecialchars($user['userEmail']); ?></td>
							<td><?php echo $user['isAdmin'] ? 'Yes' : 'No'; ?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>

		<div class="admin-card">
			<h2>Sceances</h2>
			<table class="admin-table">
				<thead>
					<tr>
						<th>Sceance ID</th>
						<th>Date</th>
						<th>Film</th>
						<th>Room</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($sceances as $sceance): ?>
						<tr>
							<td><?php echo htmlspecialchars($sceance['sceanceId']); ?></td>
							<td><?php echo htmlspecialchars($sceance['sceanceDate']); ?></td>
							<td><?php echo htmlspecialchars($sceance['filmTitle']); ?></td>
							<td><?php echo htmlspecialchars($sceance['roomId']); ?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>

		<div class="admin-card">
			<h2>Reservations</h2>
			<table class="admin-table">
				<thead>
					<tr>
						<th>User</th>
						<th>Film</th>
						<th>Date</th>
						<th>Room</th>
						<th>Seat</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($reservations as $reservation): ?>
						<tr>
							<td><?php echo htmlspecialchars($reservation['userId']); ?></td>
							<td><?php echo htmlspecialchars($reservation['filmTitle']); ?></td>
							<td><?php echo htmlspecialchars($reservation['sceanceDate']); ?></td>
							<td><?php echo htmlspecialchars($reservation['roomId']); ?></td>
							<td><?php echo htmlspecialchars($reservation['seatRow']) . htmlspecialchars($reservation['seatColumn']); ?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>
