@extends('layouts.app')

@section('content')
<div id="add_auction">
    <div class="add_auction">
        <h1>Add Auction</h1>
        <hr class="style17" style="color:grey;">
        <form id="taskForm" method="post" class="form-horizontal">
            <div class="form-group row">
                <div class="col-lg-4">
                    <input for="example-text-input" type="text" class="form-control" name="task[]" placeholder="Auction name" />
                </div>
                <div class="col-lg-2">
                    <select for="example-text-input" class="form-control" id="sel1">
                        <option>Electronics</option>
                        <option>Fashion</option>
                        <option>Home & Garden</option>
                        <option>Motors</option>
                        <option>Music</option>
                        <option>Toys</option>
                        <option>Daily Deals</option>
                        <option>Sporting</option>
                        <option>Others</option>
                    </select>
                </div>
                <div class="col-lg-2">
                    <input for="example-text-input" type="text" class="form-control" name="task[]" placeholder="Initial price" />
                </div>
                <div class="col-lg-2 dateContainer" id="add_auction_calendar">
                    <div class="input-group-prepend">
                        <span class="input-group-text add-on">
                            <i class="fas fa-calendar-alt"></i>
                        </span>
                        <input class="form-control" type="date" id="example-date-input" style="font-size:15px;">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <textarea for="example-text-input" class="form-control" id="exampleTextarea" rows="3" placeholder="Description"></textarea>
                </div>
                <div class="col-lg-4">
                    <!-- image-preview-filename input [CUT FROM HERE]-->
                    <div class="input-group image-preview">
                        <input type="text" class="form-control image-preview-filename" disabled="disabled">
                        <!-- don't give a name === doesn't send on POST/GET -->
                        <span class="input-group-btn">
                            <!-- image-preview-clear button -->
                            <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                <span class="glyphicon glyphicon-remove"></span> Clear
                            </button>
                            <!-- image-preview-input -->
                            <div class="btn btn-default image-preview-input">
                                <div class="input-group-prepend">
                                    <span>
                                        <i class="fas fa-folder-open"></i>
                                    </span>
                                    <span class="image-preview-input-title">Add an image</span>
                                    <input type="file" accept="image/png, image/jpeg, image/gif" name="input-file-preview" />
                                    <!-- rename it -->
                                </div>
                            </div>
                        </span>
                    </div>
                    <!-- /input-group image-preview [TO HERE]-->
                </div>
            </div>
            <div class="form-group" id="add_auction_buttons">
                <button type="button" style="font-size:16px;background-color:#437ab2; color:white" class="btn">Add another auction &nbsp; &nbsp;
                    <i class="fa fa-plus"></i>
                </button>
                <button class="btn" style="font-size:16px;background-color:#437ab2; color:white" type="submit">Start auction</button>
            </div>
    </div>
</div>
</div>

</form>
</div>
</div>
@endsection