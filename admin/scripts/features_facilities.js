let feature_settings_form = document.getElementById('feature_settings_form');
let facility_settings_form = document.getElementById('facility_settings_form');


feature_settings_form.addEventListener('submit',function(e){
    e.preventDefault();
    add_feature();
})

function add_feature()
{
    let data = new FormData();
    data.append('name',feature_settings_form.elements['feature_name'].value);
    data.append('add_feature','');

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/features_facilities.php",true);

    xhr.onload = function(){

        var myModal = document.getElementById('feature-settings');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        if(this.responseText == 1){
            alert('success','New feature added.');
            feature_settings_form.elements['feature_name'].value='';
            get_features();
        }
        else{
            alert('error','Server down.');
        }

    }
    xhr.send(data);
}

function get_features()
{
    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/features_facilities.php",true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function(){
        document.getElementById('features-data').innerHTML = this.responseText;
    }
    xhr.send('get_features');
}

function rem_feature(val)
{
    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/features_facilities.php",true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function(){
        if(this.responseText == 1){
            alert('success','Feature removed.');
            get_features();
        }
        else if(this.responseText == 'room_added'){
            alert('error','Feature is added in room.');
        }
        else{
            alert('error','Server down.');
        }
    }
    xhr.send('rem_feature='+val);
}

facility_settings_form.addEventListener('submit',function(e){
    e.preventDefault();
    add_facility();
})

function add_facility()
{
    let data = new FormData();
    data.append('name',facility_settings_form.elements['facility_name'].value);
    data.append('icon',facility_settings_form.elements['facility_icon'].files[0]);
    data.append('descr',facility_settings_form.elements['facility_descr'].value);
    data.append('add_facility','');

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/features_facilities.php",true);

    xhr.onload = function(){

        var myModal = document.getElementById('facility-settings');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        if(this.responseText == 'inv_img'){
            alert('error','Only SVG images allowed.');
        }
        else if(this.responseText == 'inv_size'){
            alert('error','Image should be less than 1MB.');
        }
        else if(this.responseText == 'upd_failed'){
            alert('error','Image upload failed. Server down.');
        }
        else{
            alert('success','New facility added.');
            facility_settings_form.reset();
            get_facilities();
        }
    }
    xhr.send(data);
}

function get_facilities()
{
    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/features_facilities.php",true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function(){
        document.getElementById('facilities-data').innerHTML = this.responseText;
    }
    xhr.send('get_facilities');
}

function rem_facility(val)
{
    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/features_facilities.php",true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function(){
        if(this.responseText == 1){
            alert('success','Facility removed.');
            get_facilities();
        }
        else if(this.responseText == 'room_added'){
            alert('error','Facility is added in room.');
        }
        else{
            alert('error','Server down.');
        }
    }
    xhr.send('rem_facility='+val);
}

window.onload = function(){
    get_features();
    get_facilities();
}
