import { useState } from "react";
import AlertMessage from "../components/AlertMessage";
import VoucherForm from "../components/VoucherForm";
import SeatResult from "../components/SeatResult";

function VoucherPage() {
  const [message, setMessage] = useState({
    type: "",
    text: "",
  });

  const [seats, setSeats] = useState([]);

  return (
    <div className="container py-5">
      <div className="row justify-content-center">
        <div className="col-lg-6">
          <AlertMessage message={message} />

          <VoucherForm setSeats={setSeats} setMessage={setMessage} />

          <SeatResult seats={seats} />
        </div>
      </div>
    </div>
  );
}

export default VoucherPage;
