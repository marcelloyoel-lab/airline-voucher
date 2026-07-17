import AlertMessage from "../components/AlertMessage";
import SeatResult from "../components/SeatResult";
import VoucherForm from "../components/VoucherForm";

function VoucherPage() {
  return (
    <div className="container py-5">
      <div className="row justify-content-center">
        <div className="col-lg-6">
          <AlertMessage />
          <VoucherForm />
          <SeatResult />
        </div>
      </div>
    </div>
  );
}

export default VoucherPage;
