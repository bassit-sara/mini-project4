<?php
// ...
use Illuminate\Support\Facades\Storage; // 1. import
// ...

class AccountingController extends Controller
{
    // (index, create, edit, update, destroy ... เป็น CRUD ปกติ)

    // ตัวอย่างหน้า Create (แสดงฟอร์มสร้างรายการหนี้)
    public function create(): View
    {
        $members = User::where('role', 'member')->get();
        return view('staff.accounting.create', compact('members'));
    }

    // ตัวอย่างการบันทึก (สร้างรายการหนี้)
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'member_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0',
            'reason' => 'required|string',
        ]);
        
        Payment::create(array_merge($validated, [
            'status' => 'pending', // สถานะเริ่มต้น "ค้างจ่าย"
        ]));
        
        return redirect()->route('staff.accounting.index')->with('success', 'บันทึกรายการบัญชีเรียบร้อยแล้ว');
    }
    
    // (ฟังก์ชันสำหรับ Member อัปโหลดสลิป หรือ Staff อัปโหลดสลิป จะต้องสร้างเพิ่ม
    // เช่น storeSlip(Request $request, Payment $payment)
    // $path = $request->file('slip_image')->store('slips', 'public');
    // PaymentSlip::create([ 'payment_id' => $payment->id, 'file_path' => $path ]);
    // $payment->update(['status' => 'paid']);
    // )
}