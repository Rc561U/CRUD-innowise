describe("#6627: XML example when defined as array", () => {
  it("should render xml like json", () => {
    const expected = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<Users>\n\t<UsersApi id=\"123\" name=\"bob\">\n\t</UsersApi>\n\t<UsersApi id=\"456\" name=\"jane\">\n\t</UsersApi>\n</Users>"
    cy
      .visit("/?url=/documents/bugs/6627.yaml")
      .get("#operations-default-get_users")
      .click()
      .get(".microlight")
      .contains(expected)
  })
})
