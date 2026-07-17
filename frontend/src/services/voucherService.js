import api from "./api";

const voucherService = {
  checkVoucher(data) {
    return api.post("/check", data);
  },

  generateVoucher(data) {
    return api.post("/generate", data);
  },
};

export default voucherService;
