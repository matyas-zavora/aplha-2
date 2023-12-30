function addRow(tableID) {
    var table = document.getElementById(tableID);
    var lastRow = table.rows[table.rows.length - 1];
    var inputs = lastRow.getElementsByTagName('input');
    var input1 = inputs[0].value.trim();
    var input2 = inputs[1].value.trim();

    if (input1 !== '' && input2 !== '') {
        var rowCount = table.rows.length;
        var row = table.insertRow(rowCount);

        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);

        cell1.innerHTML = '<input class="form-control" name="input1[]" oninput="addRow(\'dataTable\')" type="text">';
        cell2.innerHTML = '<input class="form-control" name="input2[]" oninput="addRow(\'dataTable\')" type="text">';

        document.getElementById('clearBtn').style.display = 'block';
        document.getElementById('shortenBtn').style.display = 'block';
    }
}

function clearTable() {
    var confirmation = confirm("Are you sure you want to clear the table?");
    if (confirmation) {
        var table = document.getElementById('dataTable');
        while (table.rows.length > 2) {
            table.deleteRow(1);
        }

        // Clear all input fields in the remaining row
        var inputs = table.getElementsByTagName('input');
        for (var i = 0; i < inputs.length; i++) {
            inputs[i].value = '';
        }
        document.getElementById('clearBtn').style.display = 'none';
        document.getElementById('shortenBtn').style.display = 'none';
    }
}