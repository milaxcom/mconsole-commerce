var bind = function (t, i) {
  return function () {
    return t.apply(i, arguments);
  };
};
this.DiscountsTable = (function () {
  function t() {
    (this.serialize = bind(this.serialize, this)),
      (this.removeItem = bind(this.removeItem, this)),
      (this.appendItem = bind(this.appendItem, this)),
      (this.template = $(".discount-template")),
      (this.discounts = $(".discounts")),
      (this.input = $('input[name="discounts"]')),
      (this.add = ".append-discount"),
      (this.remove = ".remove-discount"),
      this.init();
  }
  return (
    (t.prototype.init = function () {
      var t, i, e, n, s;
      if (((e = this.input.val()), e !== 'null', e.length > 0))
          for (s = JSON.parse(e), i = 0, n = s.length; i < n; i++)
          (t = s[i]), this.appendItem(null, t);
      $(document).on("click", this.add, this.appendItem),
        $(document).on("click", this.remove, this.removeItem);
    }),
    (t.prototype.appendItem = function (t, i) {
      var e;
      return (
        (e = this.template.clone()),
        e.removeClass("discount-template"),
        e.addClass("discount-item"),
        e.appendTo(this.discounts),
        e.on("keyup", this.serialize),
        null != i &&
          (e.find("input").eq(0).val(i.sum),
          e.find("input").eq(1).val(i.discount)),
        e.removeClass("hide")
      );
    }),
    (t.prototype.removeItem = function (t) {
      var i;
      return (
        (i = $(t.target)),
        i.closest(".discount-item").remove(),
        this.serialize()
      );
    }),
    (t.prototype.serialize = function () {
      var t, i;
      return (
        (i = []),
        (t = this.discounts.find(".discount-item")),
        t.map(function (t, e) {
          return i.push({
            sum: $(e).find("input").eq(0).val() || 0,
            discount: $(e).find("input").eq(1).val() || 0,
          });
        }),
        this.input.val(JSON.stringify(i))
      );
    }),
    t
  );
})();
