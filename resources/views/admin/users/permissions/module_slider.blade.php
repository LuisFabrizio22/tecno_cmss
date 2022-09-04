<div class="col-md-4 d-flex">
    <div class="panel shadow">
        <div class="header">
            <h2 class="title"><i class="fas fa-folder-open" ></i>Módulo de Slider</h2>
        </div>
        <div class="inside">
            <div class="form-check">
                <input type="checkbox" value="true" name="slider_add" @if(kvfj($u->permissions, 'slider_add')) 
                checked @endif > <label for="slider_add">
                 Puede agregar sliders</label>
            </div>

            <div class="form-check">
                <input type="checkbox" value="true" name="sliders_list" @if(kvfj($u->permissions, 'sliders_list')) 
                checked @endif > <label for="category_add">
                 Puede ver lista sliders</label>
            </div>
            
            <div class="form-check">
                <input type="checkbox" value="true" name="slider_edit" @if(kvfj($u->permissions, 'slider_edit')) 
                checked @endif > <label for="slider_edit">
                 Puede ver lista sliders</label>
            </div>
            
            <div class="form-check">
                <input type="checkbox" value="true" name="slider_delete" @if(kvfj($u->permissions, 'slider_delete')) 
                checked @endif > <label for="slider_delete">
                 Puede ver lista sliders</label>
            </div>
        </div>

            