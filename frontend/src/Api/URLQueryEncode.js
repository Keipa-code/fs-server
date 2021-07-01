function URLQueryEncode (str) {
  return encodeURIComponent(str).
    // Замечание: хотя RFC3986 резервирует "!", RFC5987 это не делает, так что нам не нужно избегать этого
    replace(/['()]/g, escape). // i.e., %27 %28 %29
    replace(/\*/g, '%2A').
    // Следующее не требуется для кодирования процентов для RFC5987, так что мы можем разрешить немного больше читаемости через провод: |`^
    replace(/%(?:7C|60|5E)/g, unescape);
}
export default URLQueryEncode