import { useState } from "react";
import voucherService from "../services/voucherService";

function VoucherForm({ setSeats }) {
  const [form, setForm] = useState({
    name: "",
    id: "",
    flightNumber: "",
    date: "",
    aircraft: "",
  });

  const [errors, setErrors] = useState({});

  const handleChange = (event) => {
    const { name, value } = event.target;

    setForm((prevForm) => ({
      ...prevForm,
      [name]: value,
    }));

    setErrors((prevErrors) => ({
      ...prevErrors,
      [name]: "",
    }));
  };

  const validateForm = () => {
    const newErrors = {};

    if (!form.name.trim()) {
      newErrors.name = "Crew Name is required.";
    }

    if (!form.id.trim()) {
      newErrors.id = "Crew ID is required.";
    }

    if (!form.flightNumber.trim()) {
      newErrors.flightNumber = "Flight Number is required.";
    }

    if (!form.date) {
      newErrors.date = "Flight Date is required.";
    }

    if (!form.aircraft) {
      newErrors.aircraft = "Aircraft Type is required.";
    }

    setErrors(newErrors);

    return Object.keys(newErrors).length === 0;
  };

  const handleSubmit = async (event) => {
    event.preventDefault();

    if (!validateForm()) {
      return;
    }

    try {
      setSeats([]);

      const checkResponse = await voucherService.checkVoucher({
        flightNumber: form.flightNumber,
        date: form.date,
      });

      if (checkResponse.data.exists) {
        alert("A voucher for this flight and date already exists.");
        return;
      }

      const generateResponse = await voucherService.generateVoucher(form);

      if (generateResponse.data.success) {
        setSeats(generateResponse.data.seats);
      }
    } catch (error) {
      console.error(error);

      alert("Something went wrong. Please try again.");
    }
  };

  return (
    <div className="card shadow-sm">
      <div className="card-body">
        <h3 className="card-title mb-4">Airline Voucher Generator</h3>

        <form onSubmit={handleSubmit}>
          <div className="mb-3">
            <label className="form-label">Crew Name</label>

            <input
              type="text"
              name="name"
              value={form.name}
              onChange={handleChange}
              className={`form-control ${errors.name ? "is-invalid" : ""}`}
              placeholder="Enter crew name"
            />

            <div className="invalid-feedback">{errors.name}</div>
          </div>

          <div className="mb-3">
            <label className="form-label">Crew ID</label>

            <input
              type="text"
              name="id"
              value={form.id}
              onChange={handleChange}
              className={`form-control ${errors.id ? "is-invalid" : ""}`}
              placeholder="Enter crew ID"
            />

            <div className="invalid-feedback">{errors.id}</div>
          </div>

          <div className="mb-3">
            <label className="form-label">Flight Number</label>

            <input
              type="text"
              name="flightNumber"
              value={form.flightNumber}
              onChange={handleChange}
              className={`form-control ${
                errors.flightNumber ? "is-invalid" : ""
              }`}
              placeholder="Enter flight number"
            />

            <div className="invalid-feedback">{errors.flightNumber}</div>
          </div>

          <div className="mb-3">
            <label className="form-label">Flight Date</label>

            <input
              type="date"
              name="date"
              value={form.date}
              onChange={handleChange}
              className={`form-control ${errors.date ? "is-invalid" : ""}`}
            />

            <div className="invalid-feedback">{errors.date}</div>
          </div>

          <div className="mb-4">
            <label className="form-label">Aircraft Type</label>

            <select
              name="aircraft"
              value={form.aircraft}
              onChange={handleChange}
              className={`form-select ${errors.aircraft ? "is-invalid" : ""}`}
            >
              <option value="">Select aircraft</option>
              <option value="ATR">ATR</option>
              <option value="Airbus 320">Airbus 320</option>
              <option value="Boeing 737 Max">Boeing 737 Max</option>
            </select>

            <div className="invalid-feedback">{errors.aircraft}</div>
          </div>

          <button type="submit" className="btn btn-primary w-100">
            Generate Vouchers
          </button>
        </form>
      </div>
    </div>
  );
}

export default VoucherForm;
