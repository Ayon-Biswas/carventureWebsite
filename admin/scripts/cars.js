let add_car_form = document.getElementById('add_car_form');

add_car_form.addEventListener('submit', function (e) {
    e.preventDefault();
    add_car();
});


function add_car() {
    let data = new FormData();
    data.append('add_car', '');
    data.append('name', add_car_form.elements['name'].value);
    data.append('milage', add_car_form.elements['milage'].value);
    data.append('price', add_car_form.elements['price'].value);
    data.append('quantity', add_car_form.elements['quantity'].value);
    data.append('adult', add_car_form.elements['adult'].value);
    data.append('children', add_car_form.elements['children'].value);
    data.append('desc', add_car_form.elements['desc'].value);

 
    let features = [];
    let featureElements = add_car_form.elements['features'];
    for (let i = 0; i < featureElements.length; i++) {
        if (featureElements[i].type === 'checkbox' && featureElements[i].checked) {
            features.push(featureElements[i].value);
        }
    }

    // Accessing facilities of form. The data of which is coming from the database as inputs and labels.
    let facilities = [];
    let facilityElements = add_car_form.elements['facilities'];
    for (let i = 0; i < facilityElements.length; i++) {
        if (facilityElements[i].type === 'checkbox' && facilityElements[i].checked) {
            facilities.push(facilityElements[i].value);
        }
    }


    data.append('features', JSON.stringify(features));
    data.append('facilities', JSON.stringify(facilities));

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/cars.php", true);

    xhr.onload = function () {
        var myModal = document.getElementById('add-car');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        if (this.responseText == 1) {
            alert('success', 'New Car Added');
            add_car_form.reset();
            get_all_cars();
        } else {
            alert('error', 'Server down!');
        }
    }
    xhr.send(data);
}

function get_all_cars() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/cars.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        document.getElementById('car-data').innerHTML = this.responseText;
    }

    xhr.send('get_all_cars');
}

let edit_car_form = document.getElementById('edit_car_form');

//need some observation
function edit_details(id) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/cars.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        let data = JSON.parse(this.responseText);
        edit_car_form.elements['name'].value = data.cardata.name;
        edit_car_form.elements['milage'].value = data.cardata.milage;
        edit_car_form.elements['price'].value = data.cardata.price;
        edit_car_form.elements['quantity'].value = data.cardata.quantity;
        edit_car_form.elements['adult'].value = data.cardata.adult;
        edit_car_form.elements['children'].value = data.cardata.children;
        edit_car_form.elements['desc'].value = data.cardata.description;
        edit_car_form.elements['car_id'].value = data.cardata.id;

        var facilitiesCheckboxList = edit_car_form.elements['facilities'];

        for (var i = 0; i < facilitiesCheckboxList.length; i++) {
            var el = facilitiesCheckboxList[i];

            // Using includes without converting to Number, assuming data.facilities is an array of string values
            if (data.facilities.includes(el.value)) {
                el.checked = true;
            }
        }
    


    }
    xhr.send('get_car=' + id);
}

edit_car_form.addEventListener('submit', function (e) {
    e.preventDefault();
    submit_edit_car();
});

function submit_edit_car() {
    let data = new FormData();
    data.append('edit_car', '');
    data.append('car_id', edit_car_form.elements['car_id'].value);
    data.append('name', edit_car_form.elements['name'].value);
    data.append('milage', edit_car_form.elements['milage'].value);
    data.append('price', edit_car_form.elements['price'].value);
    data.append('quantity', edit_car_form.elements['quantity'].value);
    data.append('adult', edit_car_form.elements['adult'].value);
    data.append('children', edit_car_form.elements['children'].value);
    data.append('desc', edit_car_form.elements['desc'].value);

    // Accessing features of form. The data of which is coming from the database as inputs and labels.
    let features = [];
    let featureElements = edit_car_form.elements['features'];
    for (let i = 0; i < featureElements.length; i++) {
        if (featureElements[i].type === 'checkbox' && featureElements[i].checked) {
            features.push(featureElements[i].value);
        }
    }

    // Accessing facilities of form. The data of which is coming from the database as inputs and labels.
    let facilities = [];
    let facilityElements = edit_car_form.elements['facilities'];
    for (let i = 0; i < facilityElements.length; i++) {
        if (facilityElements[i].type === 'checkbox' && facilityElements[i].checked) {
            facilities.push(facilityElements[i].value);
        }
    }

    data.append('features', JSON.stringify(features));
    data.append('facilities', JSON.stringify(facilities));

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/cars.php", true);

    xhr.onload = function () {
        var myModal = document.getElementById('edit-car');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        if (this.responseText == 1) {
            alert('success', 'Car Data Edited');
            edit_car_form.reset();
            get_all_cars();
        } else {
            alert('error', 'Server down!');
        }
    }
    xhr.send(data);
}

function toggle_status(id, val) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/cars.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        if (this.responseText == 1) {
            alert('success', 'status toggled');
            get_all_cars();
        } else {
            alert('error', 'Server down');
        }
    }
    xhr.send('toggle_status=' + id + '&value=' + val);
}

// images of car section
let add_image_form = document.getElementById('add_image_form');

add_image_form.addEventListener('submit', function (e) {
    e.preventDefault();
    add_image();
});

function add_image() {
    let data = new FormData();
    data.append('image', add_image_form.elements['image'].files[0]);
    data.append('car_id', add_image_form.elements['car_id'].value);
    data.append('add_image', '');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/cars.php", true); //we are using FormData.So no need for request header.

    xhr.onload = function () {
        if (this.responseText == 'inv_img') {
            alert('error', 'only JPG, WEBP, JPEG or PNG are allowed!', 'image-alert');
        } else if (this.responseText == 'inv_size') {
            alert('error', 'Image should be less than 2MB!', 'image-alert');
        } else if (this.responseText == 'upd_failed') {
            alert('error', 'Image upload failed. Server down!', 'image-alert');
        } else {
            alert('success', 'New Image Added', 'image-alert');
            car_images(add_image_form.elements['car_id'].value, document.querySelector("#car-images .modal-title").innerText);
            add_image_form.reset();

        }
    }
    xhr.send(data);
}

function car_images(id, cname) {
    //selecting the name of car within #car-image a class named ".modal-title" and put in innertext
    document.querySelector("#car-images .modal-title").innerText = cname;
    add_image_form.elements['car_id'].value = id;
    add_image_form.elements['image'].value = ''; //suppose if we select an image and dont upload it the shouldn't remain selected.if we close the modal the it will be fresh

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/cars.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        document.getElementById('car-image-data').innerHTML = this.responseText;
    }
    xhr.send('get_car_images=' + id);

}

function rem_image(img_id, car_id) {
    let data = new FormData();
    data.append('image_id', img_id);
    data.append('car_id', car_id);
    data.append('rem_image', '');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/cars.php", true); //we are using FormData.So no need for request header.

    xhr.onload = function () {
        if (this.responseText == 1) {
            alert('success', 'Image Removed', 'image-alert');
            car_images(car_id, document.querySelector("#car-images .modal-title").innerText);
        } else {
            alert('error', 'Image removal failed!', 'image-alert');
        }
    }
    xhr.send(data);
}

function thumb_image(img_id, car_id) {
    let data = new FormData();
    data.append('image_id', img_id);
    data.append('car_id', car_id);
    data.append('thumb_image', '');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/cars.php", true); //we are using FormData.So no need for request header.

    xhr.onload = function () {
        if (this.responseText == 1) {
            alert('success', 'Image Thumbnail changed', 'image-alert');
            car_images(car_id, document.querySelector("#car-images .modal-title").innerText);
        } else {
            alert('error', 'Thumbnail Update failed!', 'image-alert');
        }
    }
    xhr.send(data);
}

function remove_car(car_id) {
    if (confirm("Are you sure you want to delete this car?")) //confirm() method of js shows a dialog box with a message,OK and Cancel button
    {
        let data = new FormData();
        data.append('car_id', car_id);
        data.append('remove_car', '');

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/cars.php", true); //we are using FormData.So no need for request header.

        xhr.onload = function () {
            if (this.responseText == 1) {
                alert('success', 'Car Removed');
                get_all_cars();
            } else {
                alert('error', 'Car removal failed!');
            }
        }
        xhr.send(data);
    }

}

window.onload = function () {
    get_all_cars();
}