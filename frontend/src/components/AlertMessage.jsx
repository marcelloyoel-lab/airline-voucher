function AlertMessage({ message }) {
  if (!message.text) {
    return null;
  }

  return (
    <div className={`alert alert-${message.type}`} role="alert">
      {message.text}
    </div>
  );
}

export default AlertMessage;
