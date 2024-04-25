<a class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm w-100 mb-2" href="{{ route('reads.show', $id) }}" >
    View Details
</a>

<a class="btn btn-icon btn-bg-light btn-active-color-success btn-sm w-100 mb-2" href="{{ route('reads.read', $id) }}" >
    Read From Start
</a>

<a class="btn btn-icon btn-bg-light btn-active-color-warning btn-sm w-100 mb-2" href="{{ url('http://127.0.0.1:8000/reads/' . $id . '/read?continue=true') }}" >
    Continue Reading
</a>

<a href="{{ route('reads.finish', $id) }}" class="btn btn-icon btn-bg-light btn-active-color-info btn-sm w-100 mb-2" >
    Finish Reading
</a>