import { useState } from "react";
import VoucherForm from "../components/VoucherForm";
import SeatResult from "../components/SeatResult";

function VoucherPage() {
  const [seats, setSeats] = useState([]);

  return (
    <div className="container py-5">
      <div className="row justify-content-center">
        <div className="col-lg-6">
          <VoucherForm setSeats={setSeats} />

          <SeatResult seats={seats} />
        </div>
      </div>
    </div>
  );
}

export default VoucherPage;
