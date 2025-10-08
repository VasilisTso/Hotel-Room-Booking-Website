
let general_data, contact_data;

let general_settings_form = document.getElementById('general_settings_form');
let site_title_inp = document.getElementById('site_title_inp');
let site_about_inp = document.getElementById('site_about_inp');

let contact_settings_form = document.getElementById('contact_settings_form');

function get_general()
{
    let site_title = document.getElementById('site_title');
    let site_about = document.getElementById('site_about');

    let shutdown_toggle = document.getElementById('shutdown-toggle');

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/settings_crud.php",true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function(){
        general_data = JSON.parse(this.responseText);
        
        site_title.innerText = general_data.site_title;
        site_about.innerText = general_data.site_about;

        site_title_inp.value = general_data.site_title;
        site_about_inp.value = general_data.site_about;

        if(general_data.shutdown == 0){
            shutdown_toggle.checked = false;
            shutdown_toggle.value = 0;
        }
        else{
            shutdown_toggle.checked = true;
            shutdown_toggle.value = 1;
        }
    }   

    xhr.send('get_general');
}

general_settings_form.addEventListener('submit',function(e)
{
    e.preventDefault();
    upd_general(site_title_inp.value, site_about_inp.value);
})

function upd_general(site_title_val,site_about_val)
{
    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/settings_crud.php",true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function(){

        var myModal = document.getElementById('general-settings');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        if(this.responseText == 1){
            alert('success','Changes saved.');
            get_general();
        }
        else{
            alert('error','No changes made.');
        }

    }   

    xhr.send('site_title='+site_title_val+'&site_about='+site_about_val+'&upd_general');
}

function upd_shutdown(val)
{
    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/settings_crud.php",true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function(){
        if(this.responseText == 1 && general_data.shutdown==0){
            alert('success','Site has been shutdown.');
        }
        else{
            alert('success','Shutdown mode off.');
        }
        get_general();
    }   

    xhr.send('upd_shutdown='+val);
}

function get_contact()
{
    let contact_p_id = ['address','gmap','pn','email','tw','insta','fb'];
    let iframe = document.getElementById('iframe');

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/settings_crud.php",true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function(){
        contact_data = JSON.parse(this.responseText);
        contact_data = Object.values(contact_data);

        for(i=0 ; i<contact_p_id.length ; i++){
            document.getElementById(contact_p_id[i]).innerText = contact_data[i+1];
        }
        iframe.src = contact_data[8];
        contact_inp(contact_data);
    }

    xhr.send('get_contact');
}

function contact_inp(data)
{
    let contact_inp_id = ['address_inp','gmap_inp','pn_inp','email_inp','tw_inp','insta_inp','fb_inp', 'iframe_inp'];

    for(i=0 ; i<contact_inp_id.length ; i++){
        document.getElementById(contact_inp_id[i]).value = data[i+1];
    }
}

contact_settings_form.addEventListener('submit',function(e)
{
    e.preventDefault();
    upd_contact();
})

function upd_contact()
{
    let index = ['address','gmap','pn','email','tw','insta','fb','iframe'];
    let contact_inp_id = ['address_inp','gmap_inp','pn_inp','email_inp','tw_inp','insta_inp','fb_inp','iframe_inp'];

    let data_str = "";

    for(i=0 ; i<index.length ; i++){
        data_str += index[i] + "=" + document.getElementById(contact_inp_id[i]).value + '&';
    }
    data_str += "upd_contact";

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/settings_crud.php",true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function(){

        var myModal = document.getElementById('contact-settings');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        if(this.responseText == 1){
            alert('success','Changes saved.');
            get_contact();
        }
        else{
            alert('error','No changes made.');
        }
        get_general();
    }

    xhr.send(data_str);
}

window.onload = function()
{
    get_general();
    get_contact();
}