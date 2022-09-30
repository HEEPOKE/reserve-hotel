<div wire:ignore.self class="modal fade" id="typeroomModal" tabindex="-1" aria-labelledby="typeroomModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header card-header bg-primary border-primary">
                <h5 class="modal-title" id="typeroomModalLabel">เพิ่มประเภทห้องพัก
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('add_typeroom', $id) }}">
                @method('PUT')
                @csrf
                <input type="hidden" name="company_id" value="{{ $company_id }}" />
                <div class="modal-body" id="typeroom">
                    <label>ประเภทห้องพัก</label>
                    <div class="form-row">
                        <div class="col-10">
                            <input type="text" class="form-control" name="typeroom[]" class="form-control"
                                placeholder="กรอกประเภทห้องพัก">
                        </div>
                        <div class="col-2">
                            <td><button type="button" name="add" id="add_typeroom" class="btn btn-success"><i
                                        class="fa fa-plus"></i></button></td>
                        </div>
                    </div>
                </div>
                <div class="text-secondary col-10">
                    <small>***กรุณากรอกเป็นข้อๆเเละสามารถกดปุ่ม +
                        สีเขียวเพื่อเพิ่มประเภทห้องพักอื่นๆ
                        เเละปุ่มถังขยะสีเเดงเพื่อลบข้อความที่ไม่ต้องการออก</small>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">ยืนยัน</button>
                    <button type="button" class="btn btn-secondary" wire:click="closeModal"
                        data-dismiss="modal">ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>
</div>
