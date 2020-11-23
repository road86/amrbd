<div class="row">
        <div class="col-12 col-lg-12">
          <div class="box">
            <div class="box-header with-border">
              <h6 class="box-subtitle">User Permission</h6>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                          <tbody>
                          
                            <!-- Permission-->
                           @foreach($permission as $row=>$val)
                            <td>
                                    <input type="checkbox" name="permission[]" id='{{str_replace(" ", "-", $val->name)}}' value="{{$val->name}}">
                                    <label for="{{$val->name}}">{{$val->name}}</label>
                                 </td>
                           @endforeach 
                            <!--End Permission-->                        
                          </tbody>
                        </table>                  
                    </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
