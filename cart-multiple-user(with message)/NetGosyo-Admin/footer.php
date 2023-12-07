<footer class="footer py-4  ">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                © Copyright 2022, NetGosyo
              </div>
            </div>
            <div class="col-lg-6">
              <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                <li class="nav-item">
                  <a href="#" class="nav-link text-muted">NetGosyo</a>
                </li>
                <li class="nav-item">
                  <a href="../about-us.php" class="nav-link text-muted">About Us</a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link text-muted">Privacy Policy</a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link pe-0 text-muted">Terms & Conditions</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
</footer>

</div>
</main>
<!--   Core JS Files   -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="assets/js/plugins/chartjs.min.js"></script>
  <script src="assets/js/index.js"></script>
  <script>
	$('.order').click(function() {
		let items = $(this).data('items');
		let total = 0;
		$('#tbody').html('');
		$('#modalTitle').text(items[0]['order_number']);
		items.map(row => {
			total += row.qty * row.price
			const html = `
				<tr>
					<td>${row.name}</td>
					<td>₱${row.price}</td>
					<td>${row.qty}</td>
					<td>₱${row.qty * row.price}</td>
				</tr>
			`;
			$('#tbody').append(html);
		});
		const total_row = `
				<tr>
					<td>Grand Total</td>
					<td></td>					
					<td></td>
					<td>₱${total}</td>
				</tr>
			`;

		$('#tbody').append(total_row);
		$('#orderModal').modal('show');
	});

	$('[data-dismiss="modal"]').click(function() {
		$('#orderModal').modal('hide');
	});
</script>

<script>
	$(document).ready(function() {
		var convo_div = document.getElementById("convo");
		convo_div.scrollTop = convo_div.scrollHeight;
	});
</script>
</body>

</html>