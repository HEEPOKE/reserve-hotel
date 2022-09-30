<div wire:ignore.self class="modal fade" id="deletetypeModal{{ $i }}" tabindex="-1"
    aria-labelledby="deletetypeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title" id="deletetypeModalLabel">
                    ยืนยันการลบประเภทห้องพัก</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('deletetye', $id) }}" method="POST">
                @csrf
                <div class="modal-body">

                    <input type="hidden" name="typeroom" value="{{ $Stringtype }}">
                    <input type="hidden" name="index_delete" value="{{ $i }}">

                    <h5 class="text-center mb-6">ยืนยันที่จะลบห้องพักประเภท {{ $Arraytype[$i] }} นี้</h5>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">ยืนยัน</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
                        ยกเลิก
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
