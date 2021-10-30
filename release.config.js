module.exports = {
  branches: "main",
  repositoryUrl: "https://github.com/gunawanpras/simple-react-app",
  plugins: [
    "@semantic-release/commit-analyzer",
    "@semantic-release/release-notes-generator",
    ["@semantic-release/github", {
        assets: [
            { path: "./build", label: "Build" },
            { path: "./coverage", label: "Coverage" }
        ]
    }],
  ],
};
