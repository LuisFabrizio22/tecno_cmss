<div class="col-md-4 d-flex">
    <div class="panel shadow">
        <div class="header">
            <h2 class="title"><i class="fas fa-shipping-fast"></i>Modulo de coberturas</h2>
        </div>
     
            <div class="inside">
                <div class="form-check">
                    <input type="checkbox" value="true" name="coverage_list" @if(kvfj($u->permissions, 'coverage_list')) 
                    checked @endif > <label for="coverage_list">
                     Puede ver lista de coberturas</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" value="true" name="coverage_add" @if(kvfj($u->permissions, 'coverage_add')) 
                    checked @endif > <label for="coverage_add">
                     Puede agregar nuevas coberturas</label>
                </div>
               

            </div>
        
    </div>
</div>