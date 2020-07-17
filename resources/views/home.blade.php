@extends('layouts.app')

@section('content')
    <div class="page">
        <div class="page-header">
            <h1 class="page-title">Form General Elements</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Forms</a></li>
                <li class="breadcrumb-item active">General</li>
            </ol>
        </div>

        <div class="page-content">
            <!-- Panel Form Elements -->
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Form Elements</h3>
                </div>
                <div class="panel-body container-fluid">
                    <div class="row row-lg">
                        <div class="col-md-6 col-lg-4">
                            <!-- Example Rounded Input -->
                            <div class="example-wrap">
                                <h4 class="example-title">Rounded Input</h4>
                                <input type="text" class="form-control round" id="inputRounded">
                            </div>
                            <!-- End Example Rounded Input -->
                        </div>

                        <div class="col-md-6 col-lg-4">
                            <!-- Example Disable -->
                            <div class="example-wrap">
                                <h4 class="example-title">Disable</h4>
                                <input type="text" class="form-control" id="inputDisabled" placeholder="Disabled input here..." disabled="">
                            </div>
                            <!-- End Example Disable -->
                        </div>

                        <div class="col-md-6 col-lg-4">
                            <!-- Example Input Focus -->
                            <div class="example-wrap">
                                <h4 class="example-title">Input Focus</h4>
                                <input type="text" class="form-control focus" id="inputFocus" value="This is focused...">
                            </div>
                            <!-- End Example Input Focus -->
                        </div>

                        <div class="col-md-6 col-lg-4">
                            <!-- Example Placeholder -->
                            <div class="example-wrap">
                                <h4 class="example-title">Placeholder</h4>
                                <input type="text" class="form-control" id="inputPlaceholder" placeholder="placeholder">
                            </div>
                            <!-- End Example Placeholder -->
                        </div>

                        <div class="col-md-6 col-lg-4">
                            <!-- Example Static Control -->
                            <div class="example-wrap">
                                <h4 class="example-title">Static Control</h4>
                                <p class="form-control-plaintext">email@example.com</p>
                            </div>
                            <!-- End Example Static Control -->
                        </div>

                        <div class="col-md-6 col-lg-4">
                            <!-- Example File Upload -->
                            <div class="example-wrap">
                                <h4 class="example-title">File Upload</h4>
                                <div class="form-group">
                                    <div class="input-group input-group-file" data-plugin="inputGroupFile">
                                        <input type="text" class="form-control" readonly="">
                                        <span class="input-group-btn">
                        <span class="btn btn-success btn-file">
                          <i class="icon wb-upload" aria-hidden="true"></i>
                          <input type="file" name="" multiple="">
                        </span>
                      </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-file" data-plugin="inputGroupFile">
                                        <input type="text" class="form-control" readonly="">
                                        <span class="input-group-btn">
                        <span class="btn btn-outline btn-file">
                          <i class="icon wb-upload" aria-hidden="true"></i>
                          <input type="file" name="" multiple="">
                        </span>
                      </span>
                                    </div>
                                </div>
                            </div>
                            <!-- End Example File Upload -->
                        </div>

                        <div class="col-md-6 col-lg-4">
                            <!-- Example With Help -->
                            <div class="example-wrap">
                                <h4 class="example-title">With Help</h4>
                                <input type="text" class="form-control" id="inputHelpText">
                                <span class="text-help">A block of help text that breaks onto a new line and may extend
                    beyond one line.</span>
                            </div>
                            <!-- End Example With Help -->
                        </div>

                        <div class="col-md-6 col-lg-4">
                            <!-- Example Search -->
                            <div class="example-wrap">
                                <h4 class="example-title">Search</h4>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="" placeholder="Search...">
                                        <span class="input-group-btn">
                        <button type="submit" class="btn btn-primary"><i class="icon wb-search" aria-hidden="true"></i></button>
                      </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-search">
                                        <button type="submit" class="input-search-btn"><i class="icon wb-search" aria-hidden="true"></i></button>
                                        <input type="text" class="form-control" name="" placeholder="Search...">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-search input-search-dark">
                                        <i class="input-search-icon wb-search" aria-hidden="true"></i>
                                        <input type="text" class="form-control" name="" placeholder="Search...">
                                        <button type="button" class="input-search-close icon wb-close" aria-label="Close"></button>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-search">
                                        <i class="input-search-icon wb-search" aria-hidden="true"></i>
                                        <input type="text" class="form-control" name="" placeholder="Search...">
                                        <button type="button" class="input-search-close icon wb-close" aria-label="Close"></button>
                                    </div>
                                </div>

                            </div>
                            <!-- End Example Search -->
                        </div>

                        <div class="col-md-6 col-lg-4">
                            <!-- Example Size -->
                            <div class="example-wrap">
                                <h4 class="example-title">Size</h4>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" placeholder="Small">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Normal">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" placeholder="Big">
                                </div>
                            </div>
                            <!-- End Example Size -->
                        </div>

                        <div class="col-md-6">
                            <!-- Example Select -->
                            <div class="example-wrap m-sm-0">
                                <h4 class="example-title">Select</h4>
                                <div class="form-group">
                                    <select class="form-control">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" multiple="">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div>
                            </div>
                            <!-- End Example Select -->
                        </div>

                        <div class="col-md-6">
                            <!-- Example Textarea -->
                            <div class="example-wrap">
                                <h4 class="example-title">Textarea</h4>
                                <textarea class="form-control" id="textareaDefault" rows="3"></textarea>
                            </div>
                            <!-- End Example Textarea -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Panel Form Elements -->


        </div>
    </div>

@endsection
