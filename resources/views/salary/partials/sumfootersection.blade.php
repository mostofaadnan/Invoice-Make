<style>
    .full-height {
        height: 100%;
    }

    .footer {
        margin: auto;

        left: 0;
        bottom: 0;
        width: 100%;
        background-color: #001f3f !important;
        color: white;
        /* text-align: center; */
        z-index: 9999;
    }

    .section-card-body {
        margin-top: 40px;
    }

    .sum-section {

        font-style: bold;
        color: #fff;

    }

    .btn-rounded {
        border-radius: 10em;
    }

    .btn-danger {
        background-color: #ff3547;
        color: #fff;
    }

    .btn-light {
        color: #000 !important;

    }

    /*     .btn-submit {

        margin: .375rem;
        color: inherit;
        text-transform: uppercase;
        word-wrap: break-word;
        white-space: normal;
        cursor: pointer;
        border: 0;
        border-radius: .125rem;
        -webkit-box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
        box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
        -webkit-transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;
        transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;
        transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;
        padding: .84rem 2.14rem;
        font-size: .81rem;
    } */
</style>
<div class="form-row mb-2 ">
    <div class="col-md-2">
        <label for="validationDefault01">@lang('home.salary')</label>
        <input type="text" class="form-control sum-section" id="totalsalary" placeholder="salary" value="0" readonly>
    </div>
    <div class="col-md-2">
        <label for="validationDefault01">@lang('home.overtime')</label>
        <input type="text" class="form-control sum-section" id="totalovertime" placeholder="overtime" value="0" readonly>
    </div>
    <div class="col-md-1">
        <label for="validationDefault01">@lang('home.bonus')</label>
        <input type="text" class="form-control sum-section" id="totalbonus" placeholder="bonus" value="0" readonly>
    </div>
    <div class="col-md-2 ">
        <label for="validationDefault01">@lang('home.reduction')</label>
        <input type="text" class="form-control sum-section" id="totalreduction" placeholder="reduction" value="0" readonly>
    </div>
    <div class="col-md-2">
        <label for="validationDefault01">@lang('home.nettotal')</label>
        <input type="text" class="form-control sum-section" id="netsalary" placeholder="nettotal" value="0" readonly>
    </div>
    <div class="col-md-3">
        
        <button type="button" id="submittData" class="btn btn-lg btn-danger mt-3" name="button">@lang('home.submit')</button>
        <button type="button" id="resteBtn" class="btn btn-lg btn-light mt-3" name="button">@lang('home.reset')</button>
    </div>
</div>