import { useState } from "react";

function VoucherForm() {
  const [form, setForm] = useState({
    crewName: "",
    crewId: "",
    flightNumber: "",
    flightDate: "",
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

    if (!form.crewName.trim()) {
      newErrors.crewName = "Crew Name is required.";
    }

    if (!form.crewId.trim()) {
      newErrors.crewId = "Crew ID is required.";
    }

    if (!form.flightNumber.trim()) {
      newErrors.flightNumber = "Flight Number is required.";
    }

    if (!form.flightDate) {
      newErrors.flightDate = "Flight Date is required.";
    }

    if (!form.aircraft) {
      newErrors.aircraft = "Aircraft Type is required.";
    }

    setErrors(newErrors);

    return Object.keys(newErrors).length === 0;
  };

  const handleSubmit = (event) => {
    event.preventDefault();

    if (!validateForm()) {
      return;
    }

    console.log(form);
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
              name="crewName"
              value={form.crewName}
              onChange={handleChange}
              className={`form-control ${errors.crewName ? "is-invalid" : ""}`}
              placeholder="Enter crew name"
            />

            <div className="invalid-feedback">{errors.crewName}</div>
          </div>

          <div className="mb-3">
            <label className="form-label">Crew ID</label>

            <input
              type="text"
              name="crewId"
              value={form.crewId}
              onChange={handleChange}
              className={`form-control ${errors.crewId ? "is-invalid" : ""}`}
              placeholder="Enter crew ID"
            />

            <div className="invalid-feedback">{errors.crewId}</div>
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
              name="flightDate"
              value={form.flightDate}
              onChange={handleChange}
              className={`form-control ${
                errors.flightDate ? "is-invalid" : ""
              }`}
            />

            <div className="invalid-feedback">{errors.flightDate}</div>
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
