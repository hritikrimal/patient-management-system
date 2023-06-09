$(document).ready(function () {
	function fetch() {
		$.ajax({
			url: "/first_project/Generate_invoice/fetch_billing",
			dataType: "json",
			type: "post",
			data: {},
			success: function (response) {
				if (response.success) {
					// console.log(response);
					var tbody = "";
					var i = "1";
					for (var key in response.data) {
						tbody += "<tr>";
						tbody += "<td>" + i++ + "</td>";
						tbody += "<td>" + response.data[key]["billing_date"] + "</td>";
						tbody += "<td>" + response.data[key]["sample_no"] + "</td>";
						tbody += "<td>" + response.data[key]["discount_percent"] + "</td>";
						tbody += "<td>" + response.data[key]["subtotal"] + "</td>";
						tbody += "<td>" + response.data[key]["net_total"] + "</td>";

						tbody += `<td>
					    <div class="d-flex">
					        <a href="#" id="view_bill" class="btn btn-primary btn-sm m-1 view" value="${response.data[key]["sample_no"]}">View</a>
					    </div>
					</td>`;
						tbody += "</tr>";
					}
					$("#tbody").html(tbody);
					$("#myTable").DataTable();
				} else {
					// Display validation errors
					alert(response.errors);
				}
			},
		});
	}
	// Call the fetch function to populate the table and initialize the DataTable
	fetch();

	$(document).on("click", "#view_bill", function () {
		var sampleno_id = $(this).attr("value");
		// alert(sampleno_id);
		$("#bill_modal").modal("show");
		$.ajax({
			url: "/first_project/Generate_invoice/fetch_invoice",
			dataType: "json",
			type: "post",
			data: {
				sampleno_id: sampleno_id,
			},
			success: function (response) {
				if (response.success) {
					console.log(response);
					const data = response.alldata;

					$(".date").text("Billing Date: " + data.row.billing_date);
					$(".Patient_name").text("Name: " + data.row.Name);
					$(".Patient_id").text("Patient Id: " + data.row.Patientid);

					$(".subtotal").text(data.row.subtotal);
					$(".discountper").text(data.row.discount_percent);
					$(".discountamt").text(data.row.discount_amount);
					$(".grandtotal").text(data.row.net_total);
					$(".sample").text("Bill Number: " + data.row.sample_no);

					// Appending the data
					function show() {
						var tbody = "";
						var i = 1;
						data.array.forEach(function (item) {
							tbody += "<tr>";
							tbody += "<td>" + i++ + "</td>";
							tbody += "<td>" + item.test_items + "</td>";
							tbody += "<td>" + item.unit + "</td>";
							tbody += "<td>" + item.qty + "</td>";
							tbody += "<td>" + item.price + "</td>";
							tbody += "</tr>";
						});
						$("#invoive_table").html(tbody);
					}
					show();
				} else {
					// Display validation errors
					alert(response.errors);
				}
			},
		});
	});
});
