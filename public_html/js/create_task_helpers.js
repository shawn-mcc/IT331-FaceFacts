function createDocRequest(lines) {
    console.log("Creating doc request for " + lines);
    var columns = 1;
    var rows = document.createElement("tr");
    rows.id = "tr" + lines;
    if (lines == 1) {
        document.getElementById("taskTableBody").appendChild(rows);
    } else {
        document.getElementById("tr" + (lines - 1)).insertAdjacentElement("afterend", rows);
    }

    //Name
    var name_col = document.createElement("td");
    name_col.id = "tr" + lines + "td" + columns;
    var doc_name = "<label class='form-label' id='label" + lines + "'> Requested Document </label><textarea required class='form-control' id='document" + lines + "' name='document_" + lines + "' placeholder='Please enter the name of the document you would like to request'></textarea>";
    document.getElementById("tr" + lines).appendChild(name_col);
    document.getElementById("tr" + lines + "td" + columns).innerHTML = doc_name;
    columns++;
    //Allowed Doc Types

    var allowed_types = ["PDF", "DOC", "DOCX", "XLS", "XLSX", "PPT", "PPTX", "TXT", "ZIP"];
    var type_dropdown = "<select required class='selectpicker' onChange='modifyAllowedDocTypes(" + lines + ",this.value)' id='type" + lines + "' name='type_" + lines + "'>" +
        "<option value='' hidden disabled selected value>Filetypes</option>";
    for (var i = 0; i < allowed_types.length; i++) {
        type_dropdown += "<option value='" + allowed_types[i] + "'>" + allowed_types[i] + "</option>";
    }
    var type_col = document.createElement("td");
    type_col.id = "tr" + lines + "td" + columns;
    var type = "<label class='form-label' id='typeLabel" + lines + "'> Approved Document Types: </label><br />" +
        type_dropdown

    document.getElementById("tr" + lines).appendChild(type_col);
    document.getElementById("tr" + lines + "td" + columns).innerHTML = type;
    document.getElementById("tr" + lines + "td" + columns);
    columns++;
    // Delete
    if (lines > 1) {
        var delete_col = document.createElement("td");
        delete_col.id = "tr" + lines + "td" + columns;
        var delete_button = "<button type='button' class='btn btn-danger' style='align:right' onClick='deleteLine(" + lines + ")'>Delete</button>";
        document.getElementById("tr" + lines).appendChild(delete_col);
        document.getElementById("tr" + lines + "td" + columns).innerHTML = delete_button;
        columns++;
    } else { // TODO This isn't the most elegant way to do this, but it works. Otherwise the table jumps around when adding a new column
        var delete_col = document.createElement("td");
        delete_col.id = "tr" + lines + "td" + columns;
        var delete_button = "<button type='button' class='btn btn-outline-light btn-lg' style='align:right' disabled>Delete</button>";
        document.getElementById("tr" + lines).appendChild(delete_col);
        document.getElementById("tr" + lines + "td" + columns).innerHTML = delete_button;
        columns++;
    }


}
function modifyAllowedDocTypes(lines, type) { //TODO Only acutally uploads the first type to the database right now. Fix logic to reurn str list of types when not in time crunch
    base = document.getElementById("typeLabel" + lines).innerHTML;
    approved_types = base.split(":")[1].split(",");
    console.log(approved_types);
    if (approved_types[0] == " ") { // Gets rid of annoying , at the beginning of the list 
        approved_types.splice(0, 1);
    }
    if (approved_types.includes(type)) {
        approved_types.splice(approved_types.indexOf(type), 1);

    } else {
        approved_types.push(type);
    }
    document.getElementById("typeLabel" + lines).innerHTML = "Approved Document Types: " + approved_types.join(",");
}
function createSurveyForm(lines) {
    console.log("Creating Survey request for " + lines);
    var columns = 1;
    var rows = document.createElement("tr");
    rows.id = "tr" + lines;
    if (lines == 1) {
        document.getElementById("taskTableBody").appendChild(rows);
    } else {
        document.getElementById("tr" + (lines - 1)).insertAdjacentElement("afterend", rows);
    }

    //Name
    var name_col = document.createElement("td");
    name_col.id = "tr" + lines + "td" + columns;
    var question = "<label class='form-label' id='label" + lines + "'> Question " + lines + "</label><textarea required class='form-control' id='question" + lines + "' name='question_" + lines + "' placeholder='Type your question here'></textarea>";
    document.getElementById("tr" + lines).appendChild(name_col);
    document.getElementById("tr" + lines + "td" + columns).innerHTML = question;
    columns++;
    //Answer Type
    var answer_type = ["Text", "Dropdown", "True/False", "Number"]; //TODO add more types like Multiple Choice
    var type_dropdown = "<select required class='selectpicker' id='type" + lines + "' name='type_" + lines + "'>" +
        "<option value='' hidden disabled selected value>Answer Type</option>";
    for (var i = 0; i < answer_type.length; i++) {
        type_dropdown += "<option value='" + answer_type[i] + "'>" + answer_type[i] + "</option>";
    }
    var type_col = document.createElement("td");
    type_col.id = "tr" + lines + "td" + columns;
    var type = "<label class='form-label' id='typeLabel" + lines + "'> Chose Answer Type: </label><br />" +
        type_dropdown

    document.getElementById("tr" + lines).appendChild(type_col);
    document.getElementById("tr" + lines + "td" + columns).innerHTML = type;
    document.getElementById("tr" + lines + "td" + columns);
    columns++;
    //Delete
    if (lines > 1) {
        var delete_col = document.createElement("td");
        delete_col.id = "tr" + lines + "td" + columns;
        var delete_button = "<button type='button' class='btn btn-danger' style='align:right' onClick='deleteLine(" + lines + ")'>Delete</button>";
        document.getElementById("tr" + lines).appendChild(delete_col);
        document.getElementById("tr" + lines + "td" + columns).innerHTML = delete_button;
        columns++;
    } else {
        var delete_col = document.createElement("td");
        delete_col.id = "tr" + lines + "td" + columns;
        var delete_button = "<button type='button' class='btn btn-outline-light btn-lg' style='align:right' disabled>Delete</button>";
        document.getElementById("tr" + lines).appendChild(delete_col);
        document.getElementById("tr" + lines + "td" + columns).innerHTML = delete_button;
        columns++;
    }

}
function createPaymentTask(lines) {
    console.log("Creating line item for " + lines);
    var columns = 1;
    var rows = document.createElement("tr");
    rows.id = "tr" + lines;
    if (lines == 1) {
        document.getElementById("taskTableBody").appendChild(rows);
    } else {
        document.getElementById("tr" + (lines - 1)).insertAdjacentElement("afterend", rows);
    }
    //Name
    var name_col = document.createElement("td");
    name_col.id = "tr" + lines + "td" + columns;
    var line_item = "<label class='form-label' id='label" + lines + "'> Line Item " + lines + " </label><textarea requried class='form-control' id='line_item" + lines + "' name='line_item_" + lines + "' placeholder='Please enter the name of the charge'></textarea>";
    document.getElementById("tr" + lines).appendChild(name_col);
    document.getElementById("tr" + lines + "td" + columns).innerHTML = line_item;
    columns++;
    //Amount
    var amount_col = document.createElement("td");
    amount_col.id = "tr" + lines + "td" + columns;
    var amount = "<label class='form-label' id='amlabel" + lines + "'> Amount " + lines + " </label><input required type='number' step='0.01' class='form-control' id='amount" + lines + "' name='amount_" + lines + "' placeholder='Please enter the amount of the charge'></input>";
    document.getElementById("tr" + lines).appendChild(amount_col);
    document.getElementById("tr" + lines + "td" + columns).innerHTML = amount;
    document.getElementById("tr" + lines + "td" + columns);
    columns++;
    //Delete
    if (lines > 1) {
        var delete_col = document.createElement("td");
        delete_col.id = "tr" + lines + "td" + columns;
        var delete_button = "<button type='button' class='btn btn-danger' style='align:right' onClick='deleteLine(" + lines + ")'>Delete</button>";
        document.getElementById("tr" + lines).appendChild(delete_col);
        document.getElementById("tr" + lines + "td" + columns).innerHTML = delete_button;
        columns++;
    } else {
        var delete_col = document.createElement("td");
        delete_col.id = "tr" + lines + "td" + columns;
        var delete_button = "<button type='button' class='btn btn-outline-light btn-lg' style='align:right' disabled>Delete</button>";
        document.getElementById("tr" + lines).appendChild(delete_col);
        document.getElementById("tr" + lines + "td" + columns).innerHTML = delete_button;
        columns++;
    }
}
function deleteLine(line) {
    console.log("Deleting line item for " + line);
    var rows = document.getElementById("tr" + line);
    rows.remove();
}
function fetchDocRequest(data) {
    for (var i = 0; i < data.length; i++) {
        console.log (data[i]);
        let docData = Object.values(data[i]);
        let docName = Object.keys(data[i]);
        
        var lines = i + 1;
        console.log("Retriving Doc for " + lines);
        var columns = 1;
        var rows = document.createElement("tr");
        rows.id = "tr" + lines;
        if (lines == 1) {
            document.getElementById("taskTableBody").appendChild(rows);
        } else {
            document.getElementById("tr" + (lines - 1)).insertAdjacentElement("afterend", rows);
        }
        //Name
    var name_col = document.createElement("td");
    name_col.id = "tr" + lines + "td" + columns;
    var doc_name = "<label class='form-label' id='label" + lines + "'> Requested Document </label><textarea required class='form-control' id='document" + lines + "' name='document_" + lines + "'>" + docName[0]+ "</textarea>";
    document.getElementById("tr" + lines).appendChild(name_col);
    document.getElementById("tr" + lines + "td" + columns).innerHTML = doc_name;
    columns++;
    //Allowed Doc Types

    var allowed_types = ["PDF", "DOC", "DOCX", "XLS", "XLSX", "PPT", "PPTX", "TXT", "ZIP"];
    var type_dropdown = "<select required class='selectpicker' onChange='modifyAllowedDocTypes(" + lines + ",this.value)' id='type" + lines + "' name='type_" + lines + "'>" +
        "<option value=" + docData[0] + " selected value>"+ docData[0] + "</option>";
    for (var z = 0; z < allowed_types.length; z++) {
        type_dropdown += "<option value='" + allowed_types[z] + "'>" + allowed_types[z] + "</option>";
    }
    var type_col = document.createElement("td");
    type_col.id = "tr" + lines + "td" + columns;
    var type = "<label class='form-label' value = " + docData[0] + "id='typeLabel" + lines + "'> Approved Document Types: " + docData[0] + "</label><br />" +
        type_dropdown

    document.getElementById("tr" + lines).appendChild(type_col);
    document.getElementById("tr" + lines + "td" + columns).innerHTML = type;
    document.getElementById("tr" + lines + "td" + columns);
    columns++;
    // Delete
    if (lines > 1) {
        var delete_col = document.createElement("td");
        delete_col.id = "tr" + lines + "td" + columns;
        var delete_button = "<button type='button' class='btn btn-danger' style='align:right' onClick='deleteLine(" + lines + ")'>Delete</button>";
        document.getElementById("tr" + lines).appendChild(delete_col);
        document.getElementById("tr" + lines + "td" + columns).innerHTML = delete_button;
        columns++;
    } else { // TODO This isn't the most elegant way to do this, but it works. Otherwise the table jumps around when adding a new column
        var delete_col = document.createElement("td");
        delete_col.id = "tr" + lines + "td" + columns;
        var delete_button = "<button type='button' class='btn btn-outline-light btn-lg' style='align:right' disabled>Delete</button>";
        document.getElementById("tr" + lines).appendChild(delete_col);
        document.getElementById("tr" + lines + "td" + columns).innerHTML = delete_button;
        columns++;
    }
    }

}