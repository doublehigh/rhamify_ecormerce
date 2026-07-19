<div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
<div class="card border">
    <div class="card-body">
        <form action="{{route('admin.generale-setting-update')}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Site Name</label>
                <input type="text" class="form-control" name="site_name" value="{{@$generalSettings->site_name}}">
            </div>
            <div class="form-group">
                <label>Layout</label>
                <select name="layout" id="" class="form-control">
                    <option {{@$generalSettings->layout == 'LTR' ? 'selected' : ''}} value="LTR">LTR</option>
                    <option {{@$generalSettings->layout == 'RTL' ? 'selected' : ''}} value="RTL">RTL</option>
                </select>
            </div>
            <div class="form-group">
                <label>Contact Email</label>
                <input type="text" class="form-control" name="contact_email" value="{{@$generalSettings->contact_email}}">
            </div>
            <div class="form-group">
                <label>Contact Phone</label>
                <input type="text" class="form-control" name="contact_phone" value="{{@$generalSettings->contact_phone}}">
            </div>
            <div class="form-group">
                <label>Contact Address</label>
                <input type="text" class="form-control" name="contact_address" value="{{@$generalSettings->contact_address}}">
            </div>
            <div class="form-group">
                <label>Google Map Url</label>
                <input type="text" class="form-control" name="map" value="{{@$generalSettings->map}}">
            </div>
            <hr>
            <div class="form-group">
                <label>Default Currecy Name</label>
                <select name="currency_name" id="" class="form-control select2">
                    <option value="">Select</option>
                    @foreach (config('settings.currecy_list') as $currency)
                        <option {{@$generalSettings->currency_name == $currency ? 'selected' : ''}} value="{{$currency}}">{{$currency}}</option>
                    @endforeach

                </select>
            </div>
            <div class="form-group">
                <label>Currency Icon</label>
                <input type="text" class="form-control" name="currency_icon" value="{{@$generalSettings->currency_icon}}">
            </div>
            <div class="form-group">
                <label>Timezone</label>
                <select name="time_zone" id="" class="form-control select2">
                    <option value="">Select</option>
                    @foreach (config('settings.time_zone') as $key => $timeZone)
                        <option {{@$generalSettings->time_zone == $key ? 'selected' : ''}} value="{{$key}}">{{$key}}</option>
                    @endforeach
                </select>
            </div>
            <hr>
            <h6>Website Colour Combination</h6>
            <p class="text-muted">These colours control the main customer-facing website theme.</p>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Primary Colour</label>
                        <input type="color" class="form-control" name="theme_primary" value="{{@$generalSettings->theme_primary ?? '#f68b1e'}}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Primary Dark</label>
                        <input type="color" class="form-control" name="theme_primary_dark" value="{{@$generalSettings->theme_primary_dark ?? '#d97812'}}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Secondary Colour</label>
                        <input type="color" class="form-control" name="theme_secondary" value="{{@$generalSettings->theme_secondary ?? '#313133'}}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Accent Colour</label>
                        <input type="color" class="form-control" name="theme_accent" value="{{@$generalSettings->theme_accent ?? '#f68b1e'}}">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
</div>
