@extends('layouts.master')

@section('content')
<div>

    <div class="box">
        <div class="box-header">
            {{--  --}}
        </div>
        <div class="box-body table-bordered table-responsive">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="form-group">
                            {{-- <input type="radio" /> --}}
                            <label for="name">Telnet to the Server</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>
                            telnet <-hostname-> <-port->
                        </br>
                            telnet 127.0.0.1 8000
                        </label>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="form-group">
                            {{-- <input type="radio" /> --}}
                            <label for="name">SSH to a Server</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>
                                ssh ops@dev.server.com
                            </br>
                                This command will connect to the SSH server on port 22,
                                which is the default. To specify a different port,
                                add -p to the end of the command followed by the port number you want to connect
                            </br>
                                ssh ops@dev.server.com -p 2222
                        </label>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="form-group">
                            {{-- <input type="radio" /> --}}
                            <label for="name">Check the Disk Usage</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>
                            disk_free_space(directory)</br>
                            echo disk_free_space("C:");</br>
                            Return Value:	The number of free space (in bytes) on success, FALSE on failure
                        </label>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="form-group">
                            {{-- <input type="radio" /> --}}
                            <label for="name">Inode Usage</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>
                            Count Inode Usage</br>
                            - pwd</br>
                            - find . -printf "%h\n" | cut -d/ -f-2 | sort | uniq -c | sort -rn
                        </br>
                        </br>
                        <i>*Refer doc. for more details</i>
                        </label>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="form-group">
                            {{-- <input type="radio" /> --}}
                            <label for="name">Get the list of files from the path</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>
                            scandir("/images/");
                        </label>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="form-group">
                            {{-- <input type="radio" /> --}}
                            <label for="name">
                                Copy files to the remote server using FTP SFTP and SCP
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>
                            <i>*Refer doc</i>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

@endsection


@push('scripts')
    <script type="text/javascript">

        // $("#dosearch").click(function (e) {
            // e.preventDefault();
            // window.LaravelDataTables["dataTableBuilder"].page(0).draw('page');

        // });

    </script>
@endpush