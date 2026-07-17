function SeatResult({ seats }) {
  if (seats.length === 0) {
    return null;
  }

  return (
    <div className="card mt-4 shadow-sm">
      <div className="card-body">
        <h4 className="card-title mb-3">Generated Seats</h4>

        <ul className="list-group">
          {seats.map((seat) => (
            <li key={seat} className="list-group-item">
              {seat}
            </li>
          ))}
        </ul>
      </div>
    </div>
  );
}

export default SeatResult;
