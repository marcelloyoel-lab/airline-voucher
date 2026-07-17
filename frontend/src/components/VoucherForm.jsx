function VoucherForm() {
  return (
    <div className="card shadow-sm">
      <div className="card-body">
        <h3 className="card-title mb-4">Airline Voucher Generator</h3>

        <form>
          <div className="mb-3">
            <label className="form-label">Crew Name</label>
            <input
              type="text"
              className="form-control"
              placeholder="Enter crew name"
            />
          </div>

          <div className="mb-3">
            <label className="form-label">Crew ID</label>
            <input
              type="text"
              className="form-control"
              placeholder="Enter crew ID"
            />
          </div>

          <div className="mb-3">
            <label className="form-label">Flight Number</label>
            <input
              type="text"
              className="form-control"
              placeholder="Enter flight number"
            />
          </div>

          <div className="mb-3">
            <label className="form-label">Flight Date</label>
            <input type="date" className="form-control" />
          </div>

          <div className="mb-4">
            <label className="form-label">Aircraft Type</label>

            <select className="form-select">
              <option value="">Select aircraft</option>
              <option value="ATR">ATR</option>
              <option value="Airbus 320">Airbus 320</option>
              <option value="Boeing 737 Max">Boeing 737 Max</option>
            </select>
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
